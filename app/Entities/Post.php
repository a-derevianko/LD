<?php

namespace App\Entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
#[ORM\Entity]
#[ORM\Table(name: 'posts')]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Post
{
    use TimestampableEntity, SoftDeleteableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: "posts")]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    protected $author;

    /**
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: Types::STRING)]
    protected string $title;

    /**
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: Types::STRING)]
    protected string $text;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }
}