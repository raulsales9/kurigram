<?php

namespace App\Controller\Kurigram;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Follow;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/twig', name: "app_")]
class FollowsController extends AbstractController
{

    #[Route('/userFollowing/{userId}', name: 'user_following')]
public function following($userId, EntityManagerInterface $entityManager)
{
    $user = $entityManager->getRepository(User::class)->find($userId);

    if (!$user) {
        throw $this->createNotFoundException('No se encontró el usuario con el ID '.$userId);
    }

    $follows = $entityManager->getRepository(Follow::class)->findBy(['following' => $user]);

    return $this->render('/kurigram/Follows/following.html.twig', [
        'user' => $user,
        'follows' => $follows,
    ]);
}
#[Route('/userFollowers/{userId}', name: 'user_followers')]
public function followers($userId, EntityManagerInterface $entityManager)
{
    $user = $entityManager->getRepository(User::class)->find($userId);

    if (!$user) {
        throw $this->createNotFoundException('No se encontró el usuario con el ID '.$userId);
    }

    $follows = $entityManager->getRepository(Follow::class)->findBy(['following' => $user]);

    return $this->render('/kurigram/Follows/followers.html.twig', [
        'user' => $user,
        'follows' => $follows,
    ]);
}


}
