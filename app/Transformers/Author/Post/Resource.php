<?php

namespace App\Transformers\Author\Post;

use App\Transformers\BaseResource;

class Resource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt(),
        ];
    }
}