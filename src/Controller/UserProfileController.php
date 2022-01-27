<?php

namespace App\Controller;

use App\Form\EditUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\throwException;
use Twig\Extra\Markdown\MarkdownExtension;

class UserProfileController extends AbstractController
{
    #[Route('/user/profile/{id<\d+>}', name: 'user_profile')]

        public function viewCollections(EntityManagerInterface $entityManager, int $id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$entityManager->find('App:User', $id);
        if(!$user){
            throw new Exception('there is no such user');
        }
        $collections = $user->getItemsCollections();
        $owner = $user == $this->getUser();
        return $this->render('user_profile/collections.html.twig', [
            'user' => $user,
            'collections' => $collections,
            'owner' => $owner,
        ]);
    }


}
