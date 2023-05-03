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
public function users(User $user, EntityManagerInterface $entityManager): Response
{
    $loggedInUser = $this->getUser();

    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAllExceptUser($loggedInUser);

    $followRepository = $entityManager->getRepository(Follow::class);
    $followers = $followRepository->findBy(['followers' => $user]);

    return $this->render('/kurigram/Follows/followers.html.twig', [
        'users' => $users,
        'followers' => $followers,
        'targetUser' => $user,
        'loggedInUser' => $loggedInUser
    ]);
}

    #[Route('/userFollowing/{id}', name: 'following')]
    public function following(EntityManagerInterface $entityManager, $id)
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $followRepository = $entityManager->getRepository(Follow::class);
        $following = $followRepository->findBy(['following' => $user]);
        $users = [];
        foreach ($following as $follow) {
            $users[] = $follow->getFollower();
        }
        return $this->render('/kurigram/Follows/following.html.twig', [
            'users' => $users,
            'user' => $user
        ]);
    }

   /*  #[Route('/follow/{id}', name: 'follow')]
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
}  */
}
