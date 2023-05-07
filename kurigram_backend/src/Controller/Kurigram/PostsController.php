<?php

namespace App\Controller\Kurigram;

use App\Entity\Posts;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




#[Route("/twig", name: "app_")]
class PostsController extends AbstractController
{
  private $tokenStorage;

  public function __construct(TokenStorageInterface $tokenStorage)
  {
      $this->tokenStorage = $tokenStorage;
  }

  /* Find all of the posts */
  #[Route('/listPosts/{page?}', name: 'Post')]
  public function listPosts(?int $page, EntityManagerInterface $entityManager, SessionInterface $session, Security $security): Response
  {
    $post = $entityManager->getRepository(Posts::class)->findAll();
    $users = [];

    foreach ($post as $p) {
      $users[] = $p->getIdUser();
    }

    return $this->render('/kurigram/Post/ListAllPost.html.twig', [
      'user' => $users,
      'posts' => $post,
      "page" => $this->getLastPage($page, $session),
    ]);
  }


  #[Route('/insertPosts', name: 'insert_posts')]
  public function insert(Request $request, PostsRepository $repository, TokenStorageInterface $tokenStorage, UserRepository $userRepository): Response
  {
      $token = $tokenStorage->getToken();
      if (!$token) {
          throw new \LogicException('No authentication token found');
      }
  
      $user = $userRepository->find($token->getUser()->getId());
  
      if ($request->isMethod('POST')) {
          $repository->insert($request, $user, $this->getParameter('image_directory'));
  
          return $this->redirectToRoute('app_Post');
      }
  
      return $this->render('/kurigram/Post/InsertPost.html.twig');
  }
  private function getLastPage($page, $session): int
  {
    if ($page != null) {
      $session->set("page", $page);
      return $page;
    } elseif (!$session->has("page") || !is_numeric($session->get("page"))) {
      $session->set("page", 1);
      return 1;
    }
    return $session->get("page");
  }
}
