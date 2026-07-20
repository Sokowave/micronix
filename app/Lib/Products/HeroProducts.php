<?php

namespace App\Lib\Products;

use App\Data\ProductCardData;
use App\Models\Product;
use Illuminate\Support\Collection;

class HeroProducts
{
    /**
     * Get hero products.
     *
     * Priority:
     * 1. Featured products.
     * 2. Newest published products (excluding featured already selected).
     */
    public static function get(int $limit = 24): Collection
    {
        $featured = Product::query()
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

        $remaining = $limit - $featured->count();

        if ($remaining <= 0) {
            return ProductCardData::collect($featured);
        }

        $newest = Product::query()
            ->published()
            ->whereNotIn('id', $featured->pluck('id'))
            ->with([
                'mainImage',
                'category',
                'brand',
            ])
            ->latest('published_at')
            ->take($remaining)
            ->get();

        return ProductCardData::collect(
            $featured->concat($newest)->values()
        );
    }
}