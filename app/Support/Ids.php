<?php

namespace App\Support;

use Illuminate\Support\Str;

class Ids
{
    /**
     * Generate lowercase ULID
     */
    public static function ulid(): string
    {
        return strtolower((string) Str::ulid());
    }

    /**
     * Generate lowercase public ID with optional prefix
     */
    public static function publicId(?string $prefix = null): string
    {
        $id = strtolower((string) Str::ulid());

        return $prefix
            ? strtolower($prefix) . '_' . $id
            : $id;
    }
}
