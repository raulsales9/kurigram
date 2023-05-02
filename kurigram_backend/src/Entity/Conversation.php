<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id")]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: "Participant", mappedBy: "conversation")]
    private $participants;

    #[ORM\OneToOne(targetEntity: "Message")]
    #[ORM\JoinColumn(name: "last_message_id", referencedColumnName: "id")]
    private $lastMessage;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'conversations')]
    #[ORM\JoinTable(name: 'conversation_user')]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'conversation')]
    private Collection $messages;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

  
}
