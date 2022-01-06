<?php

namespace App\Transformers\Author\Post;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request): AnonymousResourceCollection
    {
        return Resource::collection($this->collection);
    }
}