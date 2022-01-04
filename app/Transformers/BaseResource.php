<?php

namespace App\Transformers;

use Doctrine\ORM\PersistentCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class BaseResource extends JsonResource
{
    protected function whenNotEmpty($relation)
    {
        $default = new MissingValue;

        if ($relation instanceof PersistentCollection) {
            $relation = $relation->toArray();
        }

        if (empty($relation)) {
            return value($default);
        }

        return value($relation);
    }
}