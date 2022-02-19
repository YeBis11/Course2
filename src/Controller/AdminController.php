<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index( EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository('App:User')->findAll();
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users,
        ]);
    }
}
