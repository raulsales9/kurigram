<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FollowsController extends AbstractController
{
    #[Route('/follows', name: 'app_follows')]
    public function index(): Response
    {
        return $this->render('follows/index.html.twig', [
            'controller_name' => 'FollowsController',
        ]);
    }
}
