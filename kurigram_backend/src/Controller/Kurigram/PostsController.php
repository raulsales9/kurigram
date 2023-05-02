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
  public function insert(Request $request, PostsRepository $repository, Security $security): Response
  {
    $user = $security->getUser();

    if (count($request->request->all())) {
      $repository->insert($request, $user);
    }

    return $this->render('/kurigram/Post/InsertPost.html.twig', []);
  }

  public function uploadFile(Request $request,  EntityManagerInterface $entityManager)
{
    // Obtener el archivo cargado
    $file = $request->files->get('file');

    // Generar un nombre de archivo único
    $fileName = md5(uniqid()) . '.' . $file->guessExtension();

    // Mover el archivo a la carpeta deseada
    $file->move(
        $this->getParameter('file_directory'),
        $fileName
    );

    // Guardar el nombre de archivo en la base de datos
    $post = new Posts();
    $post->setFile($fileName);
    $entityManager->persist($post);
    $entityManager->flush();

    // Redirigir a la página deseada
    return $this->redirectToRoute('app_post');
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
