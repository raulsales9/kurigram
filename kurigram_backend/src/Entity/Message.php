<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sentAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Conversation::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conversation $conversation = null;

    #[ORM\ManyToOne(targetEntity: Message::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'reply_message_id', referencedColumnName: 'id', nullable: true)]
    private ?Message $replyMessage = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'replyMessage')]
    private Collection $replies;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getReplyMessage(): ?Message
    {
        return $this->replyMessage;
    }

    public function setReplyMessage(?Message $replyMessage): self
    {
        $this->replyMessage = $replyMessage;

        // set (or unset) the owning side of the relation if necessary
        $newReplyMessage = $replyMessage === null ? null : $this;
        if ($replyMessage->getReplyMessage() !== $newReplyMessage) {
            $replyMessage->setReplyMessage($newReplyMessage);
        }

        return $this;
    }

    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Message $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setReplyMessage($this);
        }

        return $this;
    }

    public function removeReply(Message $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            if ($reply->getReplyMessage() === $this) {
                $reply->setReplyMessage(null);
            }
        }

        return $this;
    }
}
