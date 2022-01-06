<?php

namespace App\Repositories\Post;

use App\Entities\Post;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Repositories\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $this->getEntity());
    }

    final public function getEntity(): string
    {
        return Post::class;
    }

    public function getAll(): array
    {
        return $this->getQB()
            ->addSelect('Author')
            ->leftJoin('Post.author', 'Author')
            ->getQuery()
            ->getResult();
    }

    public function getById(int|string $id): Post
    {
        try {
        return $this->getQB()
            ->addSelect('Author')
            ->leftJoin('Post.author', 'Author')
            ->where('Post.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
        } catch (NoResultException|NonUniqueResultException $e) {
            throw new($e->getMessage());
        }
    }
}