<?php

namespace App\Controller\Kurigram;

use App\Entity\Posts;
use App\Entity\User;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;



#[Route("/twig", name: "app_")]
class PostsController extends AbstractController
{

  /* Find all of the posts */ 
    #[Route('/listPosts/{page?}', name: 'Post')]
  public function listPosts(?int $page, EntityManagerInterface $entityManager, SessionInterface $session, Security $security): Response
      {
          $post = $entityManager->getRepository(Posts::class)->findAll();
  
          return $this->render('/kurigram/Post/ListAllPost.html.twig', [
              'user' => $security->getUser(),
              'posts' => $post,
              "page" => $this->getLastPage($page, $session),
          ]);
      }


    #[Route('/insertPosts', name: 'insert_posts')]
    public function insert(Request $request, PostsRepository $repository, Security $security) : Response {
      $user = $security->getUser();
  
        if (count($request->request->all())){    
            $repository->insert($request, $user);
        }
      
        return $this->render('/kurigram/Post/InsertPost.html.twig', []);

    } 

    private function getLastPage($page, $session): int
    {
      if ($page != null) {
        $session->set("page",$page);
        return $page;
      } elseif (!$session->has("page") || !is_numeric($session->get("page"))) {
        $session->set("page",1);
        return 1;
      }
      return $session->get("page");
    }
}
