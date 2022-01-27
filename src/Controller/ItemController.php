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
    public function new(Request $request, EntityManagerInterface $entityManager, $collectionId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $parentCollection = $entityManager->find('App:ItemsCollection', $collectionId);
        if(!$this->getUser() == $parentCollection->getOwner()){
            dd ('nonon');
        }
        $item = new Item();
        $item->setParentCollection($parentCollection);

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
            'form' => $form,
        ]);
    }
}
