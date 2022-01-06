<?php

namespace App\Interfaces\Repositories;

use Doctrine\ORM\QueryBuilder;

interface RepositoryInterface
{
    public function getQB(): QueryBuilder;

    public function getEntity(): string;

    public function getAll(): array;

    public function getById(int|string $id): mixed;

    public function save(object $entity): object;

    public function destroy(object $entity): object;

}