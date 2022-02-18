<?php

namespace App\Controller;

use App\Entity\ItemsCollection;
use App\Entity\User;
use App\Form\ItemsCollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    #[Route('/user/{id<\d+>}/collection/add', name: 'collection_add')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $itemsCollection = new ItemsCollection();

        $itemsCollection->setOwner($entityManager->find('App:User', $id));

        $this->denyAccessUnlessGranted('COLLECTION_EDIT', $itemsCollection);

        $form = $this->createForm(ItemsCollectionType::class, $itemsCollection);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itemsCollection);
            $entityManager->flush();
            return $this->redirectToRoute('collection_show', [
                'id' => $id,
                'collectionId' => $itemsCollection->getId()]);
        }

        return $this->renderForm('collection/add.html.twig', [
            'CollectionForm' => $form,
        ]);
    }

    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}', name: 'collection_show')]
    public function show(Request $request, EntityManagerInterface $entityManager, int $collectionId)
    {
        $itemsCollection = $entityManager->find(ItemsCollection::class, $collectionId);
        if (!$itemsCollection) {
            throw $this->createNotFoundException(
                'There is no collection with id:' . $collectionId
            );
        }
        return $this->render('collection/show.html.twig', [
            'collection' => $itemsCollection,
        ]);


    }

    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}/edit', name: 'collection_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, int $collectionId, int $id): Response
    {

        $itemsCollection = $entityManager->find(ItemsCollection::class, $collectionId);


        if (!$itemsCollection) {
            throw $this->createNotFoundException(
                'There is no collection with id:' . $collectionId
            );
        }

        $this->denyAccessUnlessGranted('COLLECTION_EDIT', $itemsCollection);




        $form = $this->createForm(ItemsCollectionType::class, $itemsCollection);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itemsCollection);
            $entityManager->flush();
            return $this->redirectToRoute('collection_show', ['id' => $id, 'collectionId' => $collectionId]);
        }
        return $this->renderForm('collection/edit.html.twig', [
            'CollectionForm' => $form,
            'collection' => $itemsCollection,
        ]);

    }

    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}/remove', name: 'collection_remove')]
    public function delete(Request $request, EntityManagerInterface $entityManager, int $collectionId, int $id): Response
    {
        $itemsCollection = $entityManager->find('App:ItemsCollection', $collectionId);
        $this->denyAccessUnlessGranted('COLLECTION_EDIT', $itemsCollection);

        $agreement = $request->request->get('Delete_confirmation', 'No, Thanks');
        if(mb_strtolower($agreement) == 'i agree'){
            $entityManager->remove($itemsCollection);
            $entityManager->flush();
            return $this->redirectToRoute('user_profile', [
                'id' => $id,
            ]);

        }
        return $this->render('collection/delete.html.twig', [
            'id' => $id,
            'collectionId' => $collectionId,
            'collection' => $itemsCollection,
        ]);
    }

}



