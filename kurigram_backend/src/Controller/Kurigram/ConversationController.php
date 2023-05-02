<?php

namespace App\Controller\Kurigram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
    #[Route('/conversation', name: 'app_conversation')]
    public function index(): Response
    {
        return $this->render('/kurigram/conversation/index.html.twig', [
            'controller_name' => 'ConversationController',
        ]);
    }
}
