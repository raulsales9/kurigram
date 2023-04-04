<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_message = null;

    public function getIdMessage(): ?int
    {
        return $this->id_message;
    }

    public function setIdMessage(int $id_message): self
    {
        $this->id_message = $id_message;

        return $this;
    }
}
