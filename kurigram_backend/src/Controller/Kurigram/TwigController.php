<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/twig', name: 'app_')]
class TwigController extends AbstractController
{
    #[Route('/twig', name: 'ListUser')]
    public function listUsers(EntityManagerInterface $entityManager): Response
    {
        $User = $entityManager->getRepository(User::class);
        $data = [];
        for($i = 0; $i < count($User); $i++){
            $data[$i] = [
                "id" => $User[$i]-> getId()
            ];
        }
        return $this->render('twig/index.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/twig', name: 'ListUser')]
    public function detailUser(EntityManagerInterface $entityManager): Response
    {
        $User = $entityManager->getRepository(User::class)->find($usuario);
        $data = [
            "id" => $User->getId(),
            "name" => $User->getName(),
            "surnames" => $User->getSurnames(),
            "email" => $User->getEmail(),
            "roles" => ($User->getRoles()[0] === "USER") ? "Usuario" : "Administrador",
            "files" => [], 
            "phone" => $User->getPhone(),
            "events" => []
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
}
