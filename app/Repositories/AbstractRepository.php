<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\QueryBuilder;
use ReflectionClass;
use ReflectionException;

abstract class AbstractRepository extends EntityRepository implements RepositoryInterface
{
    abstract public function getEntity(): string;

    public function __construct(EntityManagerInterface $em, string $class)
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }

    public function getQB(): QueryBuilder
    {
        return $this->createQueryBuilder($this->getEntityShortName());
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getById(int|string $id): mixed
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function save(object $entity): object
    {
        try {
            $this->_em->persist($entity);
            $this->_em->flush();
        } catch (OptimisticLockException|ORMException $e) {
            throw new($e->getMessage());
        }

        return $entity;
    }

    public function destroy(object $entity): object
    {
        try {
            $this->_em->remove($entity);
            $this->_em->flush();
        } catch (OptimisticLockException|ORMException $e) {
            throw new($e->getMessage());
        }

        return $entity;
    }

    private function getEntityShortName(): string
    {
        try {
            $reflection = new ReflectionClass($this->getEntityName());
        } catch (ReflectionException $e) {
            throw new($e->getMessage());
        }

        return $reflection->getShortName();
    }
}