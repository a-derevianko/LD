<?php

namespace App\Transformers\Post;

use App\Transformers\BaseResource;

class Resource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt(),

            'author' => Author\Resource::make($this->whenNotEmpty($this->getAuthor()))
        ];
    }
}