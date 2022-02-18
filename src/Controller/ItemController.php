<?php

namespace App\Controller;

use App\Entity\BoolField;
use App\Entity\DateField;
use App\Entity\Item;
use App\Entity\NumericField;
use App\Entity\StringField;
use App\Entity\TextField;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}/additem', name: 'item_add')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $collectionId): Response
    {
        $item = new Item();
        $parentCollection = $entityManager->find('App:ItemsCollection', $collectionId);
        $item->setParentCollection($parentCollection);

        $this->denyAccessUnlessGranted('ITEM_EDIT', $item);

        foreach($parentCollection->getStringProperties() as $stringfieldname){
            if($stringfieldname){
            $stringfield = new StringField();
            $stringfield->setName($stringfieldname);
            $item->addStringField($stringfield);
            }
        }

        foreach($parentCollection->getTextProperties() as $textfieldname){
            if($textfieldname){
            $textfield = new TextField();
            $textfield->setName($textfieldname);
            $item->addTextField($textfield);
            }
        }

        foreach($parentCollection->getNumericProperties() as $numericfieldname){
            if($numericfieldname){
                $numericfield = new NumericField();
                $numericfield->setName($numericfieldname);
                $item->addNumericField($numericfield);
            }
        }

        foreach($parentCollection->getDateProperties() as $datefieldname){
            if($datefieldname){
                $datefield = new DateField();
                $datefield->setName($datefieldname);
                $item->addDateField($datefield);
            }
        }

        foreach($parentCollection->getBoolProperties() as $boolfieldname){
            if($boolfieldname){
                $boolfield = new BoolField();
                $boolfield->setName($boolfieldname);
                $item->addBoolField($boolfield);
            }
        }

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $item = $form->getData();
            $entityManager->persist($item);
            $entityManager->flush();

        }



        return $this->renderForm('item/add.html.twig', [
            'ItemForm' => $form,
        ]);
    }
    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}/item/{itemId}/edit', name: 'item_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, int $collectionId, int $id, int $itemId): Response
    {
        $item = $entityManager->find('App:Item', $itemId);
        $this->denyAccessUnlessGranted('ITEM_EDIT', $item);

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();

        }

        return $this->renderForm('item/edit.html.twig', [
           'ItemForm' => $form,
            'item' => $item,
        ]);

    }
    #[Route('/user/{id<\d+>}/collection/{collectionId<\d+>}/item/{itemId}/delete', name: 'item_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, int $collectionId, int $id, int $itemId): Response
    {
        $item = $entityManager->find('App:Item', $itemId);
        $this->denyAccessUnlessGranted('ITEM_EDIT', $item);
        $agreement = $request->request->get('Delete_confirmation', 'No, Thanks');
        if(mb_strtolower($agreement) == 'i agree'){
            $entityManager->remove($item);
            $entityManager->flush();
            return $this->redirectToRoute('collection_show', [
                'id' => $id,
                'collectionId' => $collectionId,
            ]);

        }
        return $this->render('item/delete.html.twig', [
            'id' => $id,
            'collectionId' => $collectionId,
            'itemId' => $itemId,
            'item' => $item,
        ]);
    }
}
