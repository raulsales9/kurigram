<?php

namespace App\Controller\Kurigram;

use App\Entity\User;
use App\Entity\Event;
use App\Entity\Follow;
use App\Entity\Message;
use App\Entity\Posts;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/twig', name: 'app_')]
class TwigController extends AbstractController
{
     #[Route('/listUser/{page?}', name: 'ListUser')]
    public function listUsers(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $User = $entityManager->getRepository(User::class)->findAll();
        $data = [];
        for($i = 0; $i < count($User); $i++){
            $data[$i] = [
                "id" => $User[$i]-> getId(),
                "name"=> $User[$i]->getName(),
                "email" => $User[$i]->getEmail(),
                "roles" => ($User[$i]->getRoles()[0] === "USER") ? "Usuario" : "Administrador",
                "phone" => $User[$i]->getPhone()
            ];
        }
        return $this->render('kurigram/User/AdminList.html.twig', [
            'data' => $data,
            'page' => $this->getLastPage($page, $session)
        ]);
    }

     #[Route('/detailUser/{usuario?null}', name: 'DetailUser')]
    public function detailUser(EntityManagerInterface $entityManager, int $usuario): Response
    {
        $User = $entityManager->getRepository(User::class)->find($usuario);
        $data = [
            "id" => $User->getId(),
            "name" => $User->getName(),
            "email" => $User->getEmail(),
            "roles" => ($User->getRoles()[0] === "USER") ? "Usuario" : "Administrador",
            "events" => [],
            "posts" => [],
            "messages" => []
          ];

          for($i = 0; $i < count($User->getEvent()); $i++){
            $data["events"][$i] = [
                "id" => $User->getEvent()[$i]->getId(),
                "name" => $User->getEvent()[$i]->getName(),
                "place" => $User->getEvent()[$i]->getPlace()
            ];
          }
        return $this->render('/kurigram/User/AdminDetail.html.twig', [
            'detalleClient' => $data 
        ]);
    }  

    #[Route('/insertUser', name: 'insertUser')]
    public function insert(EntityManagerInterface $gestor, Request $request): Response
    {
        $container = $request->request->all();
        if (count($container) > 1) {
             $gestor->getRepository(User::class)->insertUser($request); 
        }
        return $this->render('/kurigram/User/AdminInsert.html.twig', []);

    }

    #[Route('/deleteUser/{usuario}', name: 'deleteUser')]
    public function delete(EntityManagerInterface $gestor, int $usuario): Response
    {
        $user = $gestor->getRepository(User::class)->find($usuario);
        $gestor->getRepository(User::class)->delete($user
    
    ); 
        return $this->redirect('/twig/listUser');
    }

    #[Route('/updateUser/{usuario}', name: 'updateUser')]
    public function update(EntityManagerInterface $gestor, Request $request, int $usuario): Response
    {
        $container = $request->request->all();
        if (count($container) > 1) {
             $gestor->getRepository(User::class)->updateUser($usuario, $request); 
        }

        $user = $gestor->getRepository(User::class)->find($usuario);
        return $this->render('/kurigram/User/AdminUpdate.html.twig', [
            "user" => $user
        ]);
    }

    #[Route('/', name: 'twigRedirect')]
    public function redirectTwig(): Response
    {
        return $this->redirect('/');
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
