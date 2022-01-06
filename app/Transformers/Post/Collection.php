<?php

namespace App\Transformers\Post;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class Collection extends ResourceCollection
{
    public function toArray($request): array|AnonymousResourceCollection|JsonSerializable|Arrayable
    {
        return Resource::collection($this->collection);
    }
}