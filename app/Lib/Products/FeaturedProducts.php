<?php

namespace App\Lib\Products;

use App\Data\ProductCardData;
use App\Models\Product;
use Illuminate\Support\Collection;

class FeaturedProducts
{
    /**
     * Get featured published products.
     */
    public static function get(int $limit = 12): Collection
    {
        $products = Product::query()
            ->published()
            ->featured()
            ->with([
                'mainImage',
                'category',
                'brand',
            ])
            ->latest('published_at')
            ->take($limit)
            ->get();

        return ProductCardData::collect($products);
    }
}