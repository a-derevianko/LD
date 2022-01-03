<?php

namespace App\Repositories\Author;

use App\Entities\Author;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Illuminate\Support\Collection;

class AuthorRepository extends EntityRepository implements AuthorRepositoryInterface
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em, ObjectRepository $repository = null) {
        $this->em = $em;
        $this->repository = $repository;
        parent::__construct($this->em, $this->em->getClassMetadata(Author::class));
    }

    public function findAll()
    {
        return Collection::make($this->repository->findAll())->toArray();
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }

    public function save(Author $author): Author {
        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }

    public function delete(Author $author): Author {
        $this->em->remove($author);
        $this->em->flush();

        return $author;
    }
}