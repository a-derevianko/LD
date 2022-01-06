<?php

namespace App\Repositories\Author;

use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Repositories\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class AuthorRepository extends AbstractRepository implements AuthorRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $this->getEntity());
    }

    final public function getEntity(): string
    {
        return Author::class;
    }

    final public function getAll(): array
    {
        return $this->getQB()
            ->addSelect('Post')
            ->leftJoin('Author.posts', 'Post')
            ->getQuery()
            ->getResult();
    }

    final public function getById(int|string $id): Author
    {
        try {
            return $this->getQB()
                ->addSelect('Post')
                ->leftJoin('Author.posts', 'Post')
                ->where('Author.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException|NonUniqueResultException $e) {
            throw new($e->getMessage());
        }
    }
}