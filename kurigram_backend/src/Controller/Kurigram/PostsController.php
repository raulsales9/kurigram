<?php

namespace App\Controller\Kurigram;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route("/twig")]
class PostsController extends AbstractController
{
    #[Route('/listPosts/{page?}', name: 'app_Post')]
    public function listPosts(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $Post = $entityManager->getRepository(Posts::class)->findAll();
        $data = [];
        for($i = 0; $i < count($Post); $i++){
          $data[$i] = [
              "idPost" => $Post[$i]-> getIdPost(),
              "likes"=> $Post[$i]->getLikes(),
              "text" => $Post[$i]->getText(),
              "isSubmitted" => ($Post[$i]->getRoles()[0] === "Post") ? "Usuario" : "Administrador",
              "phone" => $Post[$i]->getPhone()
          ];
      }
        return $this->render('/kurigram/Post/ListPost.html.twig', [
            'post' => $Post,
            "page" => $this->getLastPage($page, $session),
        ]);
    }

   /*  *//*  #[Route('/posts/{id}', name: 'app_DetailPost')]
    public function detailSinglePost( EntityManagerInterface $entityManager, ?int $id): Response
    {
        $post = $entityManager->getRepository(Posts::class)->find($id);
        $custom_post = $entityManager->getRepository(Posts::class)->findPost($id);
        return $this->render('/kurigram/Post/ListPost', [
            'post' => $post,
            'custom_post' => $custom_post
        ]);
    }

    #[Route('/insertPosts', name: 'insert_event')]
    public function insert(Request $request, PostsRepository $repository) : Response {
  
      if (count($request->request->all())){
  
        $repository->insert($request);
      }
      return $this->render('/kurigram/Post/InsertPost.html.twig', []);
    } */

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
