<?php

namespace App\Repository;

use App\Entity\Posts;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PostsRepository extends ServiceEntityRepository
{
    private $userRepository;
    private $doctrine;
    private $entityManager;
    private $parameterBag;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager, UserRepository $userRepository, ParameterBagInterface $parameterBag)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->doctrine = $registry;
        $this->parameterBag = $parameterBag;
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


    public function insert(Request $request, User $user, $imageDirectory): Posts
    {
        $post = new Posts();
        $post->setTitle($request->request->get('title'));
        $post->setText($request->request->get('text'));
        $post->setIdUser($user);
        $post->setCreatedAt(new \DateTime());
        $post->setLikes(0);
        $post->setIsSubmitted(1);
    
        // Obtener el archivo cargado
        $file = $request->files->get('image');
    
        if ($file instanceof UploadedFile) {
            // Generar un nombre de archivo único
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
    
            // Mover el archivo a la carpeta deseada
            $file->move(
                $imageDirectory,
                $fileName
            );
    
            // Guardar el nombre de archivo en el objeto Posts
            $post->setImage($fileName);
        }
    
        // Persistir el objeto Posts en la base de datos
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    
        return $post;
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
