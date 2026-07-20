<?php

namespace App\Lib\Products;

use App\Data\ProductCardData;
use App\Models\Product;
use Illuminate\Support\Collection;

class RelatedProducts
{
    /**
     * Get related products.
     */
    public static function get(Product $product, int $limit = 8): Collection
    {
        $related = Product::query()
            ->published()
            ->whereKeyNot($product->getKey())
            ->where('category_id', $product->category_id)
            ->with([
                'mainImage',
                'category',
                'brand',
            ])
            ->inRandomOrder()
            ->take($limit)
            ->get();

        if ($related->count() >= $limit) {
            return ProductCardData::collect($related);
        }

        $remaining = $limit - $related->count();

        $fallback = Product::query()
            ->published()
            ->whereKeyNot($product->getKey())
            ->whereNotIn('id', $related->pluck('id'))
            ->with([
                'mainImage',
                'category',
                'brand',
            ])
            ->latest('published_at')
            ->take($remaining)
            ->get();

        return ProductCardData::collect(
            $related->concat($fallback)->values()
        );
    }
}