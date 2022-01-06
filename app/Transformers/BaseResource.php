<?php

namespace App\Transformers;

use Doctrine\ORM\PersistentCollection;
use Doctrine\Persistence\Proxy;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class BaseResource extends JsonResource
{
    protected function whenNotEmpty($relation)
    {
        $default = new MissingValue;

        if (empty($relation)) {
            return value($default);
        }

        if ($relation instanceof Proxy && !$relation->__isInitialized()) {
            return value($default);
        }

        if ($relation instanceof PersistentCollection) {
            $relation = $relation->getSnapshot();
        }

        return value($relation);
    }
}