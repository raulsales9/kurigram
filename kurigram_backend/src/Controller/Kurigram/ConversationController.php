<?php

namespace App\Controller\Kurigram;

use App\Entity\Conversation;
use App\Entity\Participant;
use App\Entity\User;
use App\Repository\ConversationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
  /*   private $userRepository;
    private $entityManager;
    private $conversation;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, ConversationRepository $conversation)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->conversation = $conversation;
    }
    #[Route('/conversation/{id}', name: 'app_conversation')]
    public function index(Request $request, int $id): Response
    {
        $otherUser = $request->get(key: "otherUser", default: 0);
        $otherUser = $this->userRepository->find($id);

        if(is_null($otherUser)){
            throw new \Exception(message:"the user was not found");
        }

        //cannot create a conversation with myself
         if($otherUser->getId() === $this->getUser()->getId()){
            throw new \Exception(message: "That's deep but you can cannot create a conversation with yourself");
        } 

        //check if conversation alredy exists
        $conversation = $this->conversation->findConversationByParticipants($otherUser->getId(), $this->getUser()->getId());
 
        if (count($conversation)){
            throw new \Exception(message: "The  conversation alredy exists");
        }
        $conversation = new Conversation();

        $participant = new Participant();
        $participant->setUser($this->getUser());
        $participant->setConversation($conversation);

        $otherParticipant = new Participant();
        $otherParticipant->setUser($otherUser);
        $otherParticipant->setConversation($conversation);

        $this->entityManager->getConnection()->beginTransaction();
        try{
            $this->entityManager->persist($conversation);
            $this->entityManager->persist($participant);
            $this->entityManager->persist($otherParticipant);

            $this->entityManager->flush();
            $this->entityManager->commit();
        }catch(\Exception $e){
            $this->entityManager->rollback();
            throw $e;
        }
        return $this->json([
            'id' => $conversation->getId()
        ],status: Response::HTTP_CREATED, [], []);
    }
 */
    
}
