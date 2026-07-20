<?php

namespace App\Lib\Products;

use App\Data\ProductCardData;
use App\Models\Product;
use Illuminate\Support\Collection;

class MoreToLove
{
    /**
     * Get a random selection of published products.
     */
    public static function get(int $limit = 24): Collection
    {
        $products = Product::query()
            ->published()
            ->with([
                'mainImage',
                'category',
                'brand',
            ])
            ->inRandomOrder()
            ->take($limit)
            ->get();

        return ProductCardData::collect($products);
    }
}