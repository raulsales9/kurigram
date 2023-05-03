<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @extends ServiceEntityRepository<Posts>
 *
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    private $userRepository;
    private $doctrine;
    private $entityManager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->doctrine = $registry;
        parent::__construct($registry, Posts::class);
    }

    public function save(Posts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Posts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
/*     public function insertApi($data): JsonResponse
    {
        $post = new Posts();
        $startDate = new \DateTime($data["created_at"]);
        
        $post->setIdPost($data['id_post'] ?? null);
        
        $user = $this->userRepository->find($data['id_user']);
    
        if (!$user) {
            throw new \InvalidArgumentException('Invalid user ID');
        }
        
        $post->setIdUser($user);
        $post->setLikes($data['likes']);
        $post->setCreatedAt($startDate);
        $post->setText($data['text']);
        $post->setIsSubmitted($data['isSubmitted'] ?? false);
        
        if (isset($data['files'])) {
            $file = file_get_contents($data['files']);
            if (!$file) {
                throw new \InvalidArgumentException('Invalid file');
            }
            $extension = pathinfo(parse_url($data['files'], PHP_URL_PATH), PATHINFO_EXTENSION);
            $post->setFile(base64_encode($file));
            $post->setFileType($extension);
        }
        
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    
        return new JsonResponse(['status' => 'Post created!'], Response::HTTP_CREATED);
    }
 */
   
    //    /**
    //     * @return Posts[] Returns an array of Posts objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Posts
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
