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
     #[Route('/listUser/{page}', name: 'ListUser')]
    public function listUsers(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $User = $entityManager->getRepository(User::class);
        $data = [];
        for($i = 0; $i < count($User); $i++){
            $data[$i] = [
                "id" => $User[$i]-> getId(),
                "name"=> $User[$i]->getName(),
                "email" => $User[$i]->getEmail(),
                "roles" => ($User[$i]->getRoles()[0] === "USER") ? "Usuario" : "Administrador",
            ];
        }
        return $this->render('twig/index.html.twig', [
            'data' => $data,
            'page' => $this->getLastPage($page, $session)
        ]);
    }

    #[Route('/detailUser/{usuario?null}', name: 'ListUser')]
    public function detailUser(EntityManagerInterface $entityManager, int $usuario): Response
    {
        $User = $entityManager->getRepository(User::class)->find($usuario);
        $data = [
            "id" => $User->getId(),
            "name" => $User->getName(),
            "surnames" => $User->getSurnames(),
            "email" => $User->getEmail(),
            "roles" => ($User->getRoles()[0] === "USER") ? "Usuario" : "Administrador",
            "events" => [],
            "posts" => [],
            "messages" => []
          ];

          for($i = 0; $i < count($User->getFiles()); $i++){
            $data["files"][$i] = [
                "idFile" => $User->getFiles()[$i]->getIdFile(),
                "name" => $User->getfiles()[$i]->getName(),
                "type" => $User->getFiles()[$i]->getType(),
                "isSubmited" => html_entity_decode(($User->getFiles()[$i]->isIsSubmited()) ? '&#x2713;' : "")
            ];
          }

          for($i = 0; $i < count($User->getEvents()); $i++){
            $data["events"][$i] = [
                "id" => $User->getEvents()[$i]->getId(),
                "name" => $User->getEvents()[$i]->getName(),
                "place" => $User->getEvents()[$i]->getPlace()
            ];
          }
        return $this->render('User/AdminDetailPanel.html.twig', [
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
        return $this->render('User/AdminInsertPanel.html.twig', []);

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
        return $this->render('User/AdminUpdatePanel.html.twig', [
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
