<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "user", inversedBy: "participants")]
    private $iduser;

    #[ORM\ManyToOne(targetEntity: "conversation", inversedBy: "participants")]
    private $conversation;

    public function getId(): ?int
    {
        return $this->id;
    }
}
