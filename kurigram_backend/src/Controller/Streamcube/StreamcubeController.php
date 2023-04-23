<?php

namespace App\Controller\Streamcube;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StreamcubeController extends AbstractController
{
    #[Route('/streamcube', name: 'app_streamcube')]
    public function index(): Response
    {
        return $this->render('streamcube/index.html.twig', [
            'controller_name' => 'StreamcubeController',
        ]);
    }
}
