<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexPageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ItemRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        //$query = $repository->findAllHydratedQuery();
        /*$pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );*/
        //dd($pagination);
        $items = $repository->findAllHydrated();
        //dd($items);
        return $this->render('index_page/index.html.twig', [
            'items' => $items,

        ]);
    }
}
