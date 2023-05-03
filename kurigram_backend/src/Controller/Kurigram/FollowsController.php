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
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/twig', name: "app_")]
class FollowsController extends AbstractController
{
    #[Route('/userFollowers/{id}', name: 'followers')]
    public function users(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAllExceptUser($user);

        $followRepository = $entityManager->getRepository(Follow::class);
        $followers = $followRepository->findBy(['followers' => $user]);

        return $this->render('/kurigram/Follows/followers.html.twig', [
            'users' => $users,
            'followers' => $followers,
        ]);
    }

    #[Route('/userFollowing/{id}', name: 'following')]
    public function following(EntityManagerInterface $entityManager)
    {
        // Obtener el usuario actual
        $user = $this->getUser();

        // Obtener el repositorio de seguidores
        $followRepository = $entityManager->getRepository(Follow::class);

        // Obtener la lista de seguidores del usuario
        $following = $followRepository->findBy(['following' => $user]);

        // Crear una lista de los usuarios seguidos por el usuario
        $users = [];
        foreach ($following as $follow) {
            $users[] = $follow->getFollower();
        }

        // Renderizar la vista con la lista de usuarios seguidos
        return $this->render('/kurigram/Follows/following.html.twig', [
            'users' => $users
        ]);
    }
    /*  
    #[Route('/follow/{id}', name: 'follow')]
    public function followUser(Request $request, EntityManagerInterface $entityManager, User $id): Response
    {
        $user = $this->getUser();
        $follow = new Follow();
        $follow->setFollowing($user);
        $follow->setFollowers($id);
        $entityManager->persist($follow);
        $entityManager->flush();

        return $this->redirectToRoute('user_profile', ['id' => $id->getId()]);
    }

    #[Route('/unfollow/{id}', name: 'unfollow')]
    public function unfollowUser(Request $request, EntityManagerInterface $entityManager, User $id): Response
    {
        $user = $this->getUser();
        $follow = $entityManager->getRepository(Follow::class)->findOneBy([
            'following' => $user,
            'followers' => $id
        ]);
        if ($follow) {
            $entityManager->remove($follow);
            $entityManager->flush();
        }
        return $this->redirectToRoute('user_profile', ['id' => $id->getId()]);
    }

    #[Route('/toggle_follow/{id}', name: 'toggle_follow')]
public function toggleFollowUser(EntityManagerInterface $entityManager, User $id): RedirectResponse
{
    $user = $this->getUser();
    $followRepository = $entityManager->getRepository(Follow::class);
    $follow = $followRepository->findOneBy([
        'following' => $user,
        'followers' => $id
    ]);

    if ($follow) {
        $entityManager->remove($follow);
        $entityManager->flush();
    } else {
        $follow = new Follow();
        $follow->setFollowing($user);
        $follow->setFollowers($id);
        $entityManager->persist($follow);
        $entityManager->flush();
    }

    return $this->redirectToRoute('user_profile', ['id' => $id->getId()]);
} */
}
