<?php

namespace App\Interfaces\Repositories;

use App\Entities\Author;

interface AuthorRepositoryInterface
{
    public function getAllAuthors(): array;

    public function getAuthorById($id): Author;

    public function store(Author $author): Author;

    public function update(Author $author): Author;

    public function destroy(Author $author): Author;
}