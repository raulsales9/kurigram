<?php

namespace App\Controller\Api;

use App\Entity\Message;
use App\Entity\Conversation;
use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

#[Route('/api/messages', name: 'api_messages')]
class MessageController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/{id}', name: 'getMessage_api', methods: ["GET"])]
    public function getMessage(EntityManagerInterface $em, $id): JsonResponse
    {
        $message = $em->getRepository(Message::class)->find($id);

        if (!$message) {
            return new JsonResponse(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $message->getId(),
            'text' => $message->getText(),
            'createdAt' => $message->getCreatedAt(),
            'user' => $message->getUser()->getName(),
            'conversation' => $message->getConversation()->getId(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/', name: 'sendMessage_api', methods: ["POST"])]
    public function sendMessage(
        Request $request,
        PublisherInterface $publisher,
        EntityManagerInterface $em,
        ConversationRepository $convRepo
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $text = $data['text'];
        $conversationId = $data['conversationId'];
        $conversation = $convRepo->find($conversationId);

        if (!$conversation) {
            return new JsonResponse(['error' => 'Conversation not found'], Response::HTTP_NOT_FOUND);
        }

        $user = $this->security->getUser();
        $message = new Message();
        $message->setText($text);
        $message->setConversation($conversation);
        $message->setUser($user);

        $em->persist($message);
        $em->flush();

        $update = new Update(
            sprintf('http://localhost/messages/%s', $conversation->getId()),
            json_encode(['message' => $text, 'user' => $user->getName()])
        );

        $publisher($update);

        return new JsonResponse(['status' => 'Message sent!'], Response::HTTP_OK);
    }

    #[Route('/conversation/{id}', name: 'getMessagesForConversation_api', methods: ["GET"])]
    public function getMessagesForConversation(EntityManagerInterface $em, $id): JsonResponse
    {
        $conversation = $em->getRepository(Conversation::class)->find($id);

        if (!$conversation) {
            return new JsonResponse(['error' => 'Conversation not found'], Response::HTTP_NOT_FOUND);
        }

        $messages = $conversation->getMessages();
        $data = [];

        foreach ($messages as $message) {
            $data[] = [
                'id' => $message->getId(),
                'text' => $message->getText(),
                'createdAt' => $message->getCreatedAt(),
                'user' => $message->getUser()->getName(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
