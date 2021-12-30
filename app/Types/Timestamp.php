<?php

namespace App\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class Timestamp extends Type
{
    public const TIMESTAMP = 'timestamp';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return static::TIMESTAMP;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Carbon
    {
        if ($value === null) {
            return null;
        }

        return Date::parse($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string|int|null|float
    {
        if ($value === null) {
            return null;
        }

        return $value->format($platform->getDateTimeFormatString());
    }

    public function getName(): string
    {
        return static::TIMESTAMP;
    }
}