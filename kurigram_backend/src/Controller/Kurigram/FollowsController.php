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

class FollowsController extends AbstractController
{
    #[Route('/following', name: 'following')]
    public function following(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $followRepository = $entityManager->getRepository(Follow::class);
        $following = $followRepository->findBy(['following' => $user]);

        return $this->render('/kurigram/Follows/following.html.twig', [
            'following' => $following,
        ]);
    }

    #[Route('/follow/{id}', name: 'follow')]
    public function followUser(Request $request, EntityManagerInterface $entityManager, string $id): Response
    {
        $user = $this->getUser();
        $userRepository = $entityManager->getRepository(User::class);
        $followedUser = $userRepository->find($id);
        if (!$followedUser) {
            throw $this->createNotFoundException('User not found');
        }
        $follow = $entityManager->getRepository(Follow::class)->findOneBy([
            'following' => $user->getId(),
            'followers' => $followedUser->getId()
        ]);
        if (!$follow) {
            $follow = new Follow();
            $follow->setFollowing($user);
            $follow->setFollowers($followedUser);
            $entityManager->persist($follow);
            $entityManager->flush();
        }
        return $this->redirectToRoute('user_profile', ['id' => $followedUser->getId()]);
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

    #[Route('/is_following', name: 'app_follows_is_following')]
    public function isFollowing(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $userId = $request->query->getInt('user_id');
        $followerId = $request->query->getInt('follower_id');

        $followRepository = $entityManager->getRepository(Follow::class);

        $isFollowing = $followRepository->isFollowing($userId, $followerId);

        return new JsonResponse(['is_following' => $isFollowing]);
    }
}
