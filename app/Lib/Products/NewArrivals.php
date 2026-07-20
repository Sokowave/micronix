<?php

namespace App\Lib\Products;

use App\Data\ProductCardData;
use App\Models\Product;
use Illuminate\Support\Collection;

class NewArrivals
{
    /**
     * Get the latest published products.
     */
    public static function get(int $limit = 12): Collection
    {
        $products = Product::query()
            ->published()
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