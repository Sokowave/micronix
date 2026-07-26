<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductIdentifiers
{
    public static function publicId(): string
    {
        return (string) Str::uuid();
    }

    public static function sku(): string
    {
        do {
            $sku = 'MICX-'.random_int(1000000, 9999999);
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }

    public static function slug(string $name): string
    {
        return Str::slug($name).'-'.Str::random(24);
    }
}