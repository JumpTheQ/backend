<?php

namespace App\Traits;

trait EnumsToArrayTrait
{
    public static function toArray(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            self::cases()
        );
    }
}
