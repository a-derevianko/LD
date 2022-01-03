<?php

namespace App\Transformers\Author;

use App\Transformers\BaseResource;
use App\Transformers\Post\Collection as PostCollection;

class Resource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt(),

            'posts' => PostCollection::make($this->whenNotEmpty($this->getPosts()))
        ];
    }
}