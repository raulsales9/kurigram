<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
    private $doctrine;
    public function __construct(ManagerRegistry $registry)
    {
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

    public function insert($data) : void
    {
        $Posts = new Posts;
        $file = $data->files->get('imagen');
        $startDate = new \DateTime($data->request->get("created_at"));
        $extension = "." . $file->getClientOriginalExtension();
        $getIds = $this->doctrine->getRepository(Posts::class)->findAll();
        $maxId = 0;
        for ($i=0; $i < count($getIds); $i++) { 
            if ($getIds[$i]->getId() > $maxId) {
                $maxId = $getIds[$i]->getId(); 
            }
        }
        $maxId++;
       $newId = $maxId;
        $Posts
            ->setIdPost($newId)
            ->setText($data->request->get("text"))
            ->setCreatedAt($startDate)
            ->setTitle($data->request->get("title"))
            ->setFile($file . $extension)
            ->setLikes(0) // Set a default value for likes
            ->setIsSubmitted(true);
        $this->doctrine->getManager()->persist($Posts);
        $this->doctrine->getManager()->flush();
    }
  


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
