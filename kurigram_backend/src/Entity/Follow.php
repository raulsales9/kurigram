<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\FollowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
class Follow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $followers = null;

    #[ORM\Column]
    private ?int $following = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'follow')]
    private Collection $idUser;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFollowers(): ?int
    {
        return $this->followers;
    }

    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;

        return $this;
    }

    public function getFollowing(): ?int
    {
        return $this->following;
    }

    public function setFollowing(int $following): self
    {
        $this->following = $following;

        return $this;
    }

    public function addFollower(User $follower): self
{
    if (!$this->idUser->contains($follower)) {
        $this->idUser->add($follower);
        $this->followers++;
    }

    return $this;
}

public function removeFollower(User $follower): self
{
    if ($this->idUser->contains($follower)) {
        $this->idUser->removeElement($follower);
        $this->followers--;
    }

    return $this;
}

public function addFollowing(User $following): self
{
    if (!$this->idUser->contains($following)) {
        $this->idUser->add($following);
        $this->following++;
    }

    return $this;
}


public function removeFollowing(User $following): self
{
    if ($this->idUser->contains($following)) {
        $this->idUser->removeElement($following);
        $this->following--;
    }

    return $this;
}

    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser->add($idUser);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        $this->idUser->removeElement($idUser);

        return $this;
    }

    
}
