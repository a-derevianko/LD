<?php

namespace App\Transformers\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
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