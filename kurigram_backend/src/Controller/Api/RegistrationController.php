<?php

namespace App\Controller\Api;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api')]
class RegistrationController extends AbstractController
{
    #[Route('/insert/user', name:'insertUser_api', methods:["POST"])]
    public function insertUser(Request $request, UserRepository $repository): JsonResponse {

        $data = json_decode($request->getContent(), true);

        $repository->insert($data);

        return new JsonResponse(["status" => "User created!"], Response::HTTP_CREATED);
    }

    #[Route('/insert/post', name:'insertPost_api', methods:["POST"])]
    public function insertPost(Request $request, PostsRepository $repository): JsonResponse {

        $data = json_decode($request->getContent(), true);

        $repository->insertApi($data);

        return new JsonResponse(["status" => "Post created!"], Response::HTTP_CREATED);
    }
}
