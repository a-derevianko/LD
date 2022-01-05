<?php

namespace App\Entities;

use App\Traits\SoftDeletes as SoftDeletesTrait;
use App\Traits\Timestamp as TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity]
#[ORM\Table(name: 'authors')]
#[Gedmo\SoftDeleteable(['fieldName' => 'deleted_at', 'timeAware' => true, 'hardDelete' => false])]
class Author
{
    use TimestampTrait, SoftDeletesTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    #[ORM\Column(type: Types::STRING)]
    protected string $name;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    protected $posts;

    #[Pure]
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function addPost(Post $post): void
    {
        if (!$this->posts->contains($post)) {
            $post->setAuthor($this);
            $this->posts->add($post);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}