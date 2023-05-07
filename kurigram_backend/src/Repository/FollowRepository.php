<?php

namespace App\Repository;
use App\Entity\User;
use App\Entity\Follow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FollowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Follow::class);
    }
    public function save(Follow $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Follow $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function isFollowing(int $userId, int $followerId): bool
    {
        $follow = $this->findOneBy(['following' => $userId, 'followers' => $followerId]);

        return $follow !== null;
    }

    
    public function followUser($followerId, $followingId)
    {
        $entityManager = $this->getEntityManager();

        $follower = $entityManager->getRepository(User::class)->find($followerId);
        $following = $entityManager->getRepository(User::class)->find($followingId);

        if (!$follower || !$following) {
            throw new \Exception('Usuario no encontrado.');
        }

        $follow = new Follow();
        $follow->setFollowers($follower->getId());
        $follow->setFollowing($following->getId());

        $entityManager->persist($follow);
        $entityManager->flush();
    }

    public function unfollowUser(int $followerId, int $followingId): void
{
    $follow = $this->findOneBy(['followers' => $followerId, 'following' => $followingId]);

    if (!$follow) {
        throw new \RuntimeException(sprintf('No follow found for follower %d and following %d', $followerId, $followingId));
    }

    $this->getEntityManager()->remove($follow);
    $this->getEntityManager()->flush();
}

}
