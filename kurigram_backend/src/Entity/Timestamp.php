<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

trait Timestamp
{
    #[ORM\Column(type: "datetime")]
    private $createdAt;

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt){
        $this->createdAt = $createdAt;
    }

    #[ORM\PrePersist()]
    public function prePersist(){
        $this->createdAt = new DateTime();
    }
}