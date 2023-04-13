<?php

namespace App\Controller\Kurigram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KurigramController extends AbstractController
{
    #[Route('/kurigram', name: 'app_kurigram')]
    public function index(): Response
    {
        return $this->render('kurigram/index.html.twig', [
            'controller_name' => 'KurigramController',
        ]);
    }
}
