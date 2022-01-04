<?php

namespace App\Transformers\Post\Author;

use App\Entities\Author;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public $collects = Author::class;

    public function toArray($request): array
    {
        return [
            'data' => Resource::collection($this->collection)
        ];
    }
}