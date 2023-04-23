<?php

namespace App\Controller\Kurigram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/kurigram/list', name: 'app_list')]
    public function index(): Response
    {
        
        return $this->render('kurigram/listKurigram.html.twig', [
            'controller_name' => 'ListController',
        ]);
    }
}
