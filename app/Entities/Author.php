<?php

namespace App\Entities;

use App\Traits\SoftDeletes as SoftDeletesTrait;
use App\Traits\Timestamp as TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'authors')]
#[Gedmo\SoftDeleteable(['fieldName' => 'deleted_at', 'timeAware' => false, 'hardDelete' => false])]
class Author
{
    use TimestampTrait, SoftDeletesTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    #[ORM\Column(type: Types::STRING)]
    protected string $name;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Author::class)]
    protected ArrayCollection|Post $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPosts(): Collection|Post
    {
        return $this->posts;
    }
}