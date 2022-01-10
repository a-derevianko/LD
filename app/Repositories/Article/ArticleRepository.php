<?php

namespace App\Repositories\Article;

use App\Entities\Article;
use App\Interfaces\Repositories\ArticleRepositoryInterface;
use App\Repositories\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class ArticleRepository extends AbstractRepository implements ArticleRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $this->getEntity());
    }

    final public function getEntity(): string
    {
        return Article::class;
    }

    public function getAll(): array
    {
        return $this->getQB()
            ->addSelect('Author')
            ->leftJoin('Article.author', 'Author')
            ->getQuery()
            ->getResult();
    }

    public function getById(int|string $id): Article
    {
        try {
        return $this->getQB()
            ->addSelect('Author')
            ->leftJoin('Article.author', 'Author')
            ->where('Article.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
        } catch (NoResultException|NonUniqueResultException $e) {
            throw new($e->getMessage());
        }
    }
}