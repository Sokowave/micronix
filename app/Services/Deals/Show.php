<?php

namespace App\Services\Deals;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class Show
{
    /**
     * Find a currently active deal by slug.
     */
    public function find(string $slug): Deal
    {
        return Deal::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->firstOrFail();
    }

    /**
     * Get active discounted products belonging to the deal.
     */
    public function products(Deal $deal): Collection
    {
        return $deal
            ->products()
            ->with([
                'brand',
                'category',
                'primaryMedia',
            ])
            ->where('products.is_active', true)
            ->whereNotNull('products.sale_price')
            ->where('products.sale_price', '>', 0)
            ->whereColumn(
                'products.sale_price',
                '<',
                'products.price'
            )
            ->get();
    }

    /**
     * Get the current active deal for a product.
     */
    public function forProduct(Product $product): ?Deal
    {
        if (! $product->details()->hasDiscount()) {
            return null;
        }

        return $product
            ->deals()
            ->where('deals.is_active', true)
            ->where('deals.starts_at', '<=', now())
            ->where('deals.ends_at', '>=', now())
            ->orderBy('deals.position')
            ->orderBy('deals.ends_at')
            ->first();
    }
}