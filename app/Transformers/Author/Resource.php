<?php

namespace App\Transformers\Author;

use App\Transformers\BaseResource;

class Resource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt(),

            'posts' => Post\Collection::make($this->whenNotEmpty($this->getPosts()))
        ];
    }
}