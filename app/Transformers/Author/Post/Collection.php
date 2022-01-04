<?php

namespace App\Transformers\Author\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => Resource::collection($this->collection)
        ];
    }
}