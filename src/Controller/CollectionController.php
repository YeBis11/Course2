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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (!($entityManager->getRepository(User::class)->find($id) == $this->getUser() ||
            $this->isGranted('ROLE_ADMIN')
        )) {
            return $this->redirectToRoute('collection_show');
        }
        $itemsCollection = new ItemsCollection();
        $itemsCollection->setOwner($this->getUser());
        $form = $this->createForm(ItemsCollectionType::class, $itemsCollection);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itemsCollection);
            $entityManager->flush();
            return $this->redirectToRoute('collection_show', [
                'id' => $this->getUser()->getId(),
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (!($entityManager->getRepository(User::class)->find($collectionId) == $this->getUser() ||
            !$this->isGranted('ROLE_ADMIN')
        )) {
            return $this->redirectToRoute('collection_show', ['id' => $id, 'collectionId' => $collectionId]);
        }

        $itemsCollection = $entityManager->find(ItemsCollection::class, $collectionId);
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $collection = $entityManager->find('App:ItemsCollection', $collectionId);
        if(!($this->getUser() == $collection ->getOwner())||!$this->isGranted('ROLE_ADMIN')){
            //$this->addFlash('error', 'You are not owner of this collection!');
            $this->redirectToRoute('index');
        }
        $agreement = $request->request->get('Delete_confirmation', 'No, Thanks');
        if(mb_strtolower($agreement) == 'i agree'){
            $entityManager->remove($collection);
            $entityManager->flush();
            return $this->redirectToRoute('user_profile', [
                'id' => $id,
            ]);

        }
        return $this->render('collection/delete.html.twig', [
            'id' => $id,
            'collectionId' => $collectionId,
            'collection' => $collection,
        ]);
    }

}



