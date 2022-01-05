<?php

namespace App\Interfaces\Repositories;

use App\Entities\Post;

interface PostRepositoryInterface
{
    public function getAllPosts(): array;

    public function getPostById($id): Post;

    public function store(Post $post): Post;

    public function update(Post $post): Post;

    public function destroy(Post $post): Post;
}