<?php

namespace App\Repositories\Author;

use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
//use Doctrine\Persistence\ObjectRepository;

class AuthorRepository extends EntityRepository implements AuthorRepositoryInterface
{
    private EntityManagerInterface $em;
//    private ObjectRepository|EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($this->em, $this->em->getClassMetadata(Author::class));
//        $this->repository = $this->em->getRepository(Author::class);
    }

    public function getAllAuthors(): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('Author', 'Post')
            ->from(Author::class, 'Author')
            ->leftJoin('Author.posts', 'Post');
        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getAuthorById(int|string $id): Author
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('Author', 'Post')
            ->from(Author::class, 'Author')
            ->leftJoin('Author.posts', 'Post')
            ->where('Author.id = :id')
            ->setParameter('id', $id);
        $query = $qb->getQuery();

        return $query->getSingleResult();
    }

    public function store(Author $author): Author
    {
        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

    public function update(Author $author): Author
    {
        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

    public function destroy(Author $author): Author
    {
        $this->em->remove($author);
        $this->em->flush();

        return $author;
    }
}