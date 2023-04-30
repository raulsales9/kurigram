<?php

namespace App\Controller\Kurigram;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/twig")]
class MessageController extends AbstractController
{

    #[Route('/messages', name: 'app_Messages', methods: ['GET'])]
    public function index(MessageRepository $messageRepository): Response
    {
        $user = $this->getUser();
        $messages = $messageRepository->findChatMessagesByUser($user);

        return $this->render('message/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/messages/chat/{recipient}', name: 'message_chat', methods: ['GET'])]
    public function chat(User $recipient, MessageRepository $messageRepository): Response
    {
        $user = $this->getUser();
        if (!$this->getUser()) {
            // Usuario no autenticado, manejar el error aquí
        }
        
        $user = $this->getUser();
        
        if (!$user) {
            // Usuario nulo, manejar el error aquí
        }
        
        $messages = $messageRepository(Message::class)
                    ->findChatMessagesByUser($user);
        $messages = $messageRepository->findChatMessagesByUsers($user, $recipient);

        return $this->render('/kurigram/message/chat.html.twig', [
            'messages' => $messages,
            'recipient' => $recipient,
        ]);
    }

    #[Route('/messages/new/{recipient}', name: 'message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, User $recipient, EntityManagerInterface $entityManager): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
            $message->addIdUser($currentUser);
            $message->addIdUser($recipient);
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('message_chat', ['recipient' => $recipient->getId()]);
        }

        return $this->render('/kurigram/message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
            'recipient' => $recipient,
        ]);
    }
}
