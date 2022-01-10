<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="authors")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
#[ORM\Entity]
#[ORM\Table(name: 'authors')]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Author
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
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: Types::STRING)]
    protected string $name;

    /**
     * @ORM\OneToMany(mappedBy="author", targetEntity="Post")
     */
    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    protected $posts;

    /**
     * @ORM\OneToMany(mappedBy="author", targetEntity="Post")
     */
    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Article::class)]
    protected $articles;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function addPost(Post $post): void
    {
        if (!$this->posts->contains($post)) {
            $post->setAuthor($this);
            $this->posts->add($post);
        }
    }

    public function addArticle(Article $article): void
    {
        if (!$this->posts->contains($article)) {
            $article->setAuthor($this);
            $this->articles->add($article);
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

    public function getArticles()
    {
        return $this->articles;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}