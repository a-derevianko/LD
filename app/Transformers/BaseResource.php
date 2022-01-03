<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class BaseResource extends JsonResource
{
    protected function whenNotEmpty($relationCollection): array|MissingValue
    {
        $collection = $relationCollection->toArray();

        if (count($collection) < 1) {
            return new MissingValue;
        }

        return $collection;
    }
}