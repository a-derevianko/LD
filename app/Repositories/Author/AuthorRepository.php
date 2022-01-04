<?php

namespace App\Repositories\Author;

use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Illuminate\Support\Collection;

class AuthorRepository extends EntityRepository implements AuthorRepositoryInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository|EntityRepository $repository;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        parent::__construct($this->em, $this->em->getClassMetadata(Author::class));
        $this->repository = $this->em->getRepository(Author::class);
    }

    public function getAllAuthors(): array
    {
        return Collection::make($this->repository->findAll())->toArray();
    }

    public function getAuthorById(int|string $id): Author
    {
        return $this->repository->find($id);
    }

    public function store(Author $author): Author {
        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

    public function update(Author $author): Author {
        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

    public function destroy(Author $author): Author {
        $this->em->remove($author);
        $this->em->flush();

        return $author;
    }
}