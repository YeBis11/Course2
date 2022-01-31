<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexPageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ItemRepository $repository): Response
    {
           
        $items = $repository->findAll();
        return $this->render('index_page/index.html.twig', [
            'items' => $items,
        ]);
    }
}
