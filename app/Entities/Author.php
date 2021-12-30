<?php

namespace App\Entities;

use App\Types\Timestamp;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

#[ORM\Entity]
#[ORM\Table(name: 'authors')]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    #[ORM\Column(type: Types::STRING)]
    protected string $name;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_at', type: Timestamp::TIMESTAMP, nullable: true)]
    protected ?\DateTime $createdAt;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(name: 'updated_at', type: Timestamp::TIMESTAMP, nullable: true)]
    protected ?\DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

//    public function getCreatedAt(): ?Carbon
//    {
//        return $this->createdAt;
//    }
//
//    public function getUpdatedAt(): ?Carbon
//    {
//        return $this->updatedAt;
//    }
//
//    public function setCreatedAt($createdAt)
//    {
//        $this->createdAt = $createdAt;
//    }
//
//    public function setUpdatedAt($updatedAt)
//    {
//        $this->updatedAt = $updatedAt;
//    }
}