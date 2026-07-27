<?php

namespace App\Services\Deals;

use App\Models\Deal;
use Illuminate\Database\Eloquent\Collection;

class Index
{
    /**
     * Get all currently active deals
     * that contain at least one discounted product.
     */
    public function get(): Collection
    {
        return Deal::query()
            ->where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->whereHas('products', fn ($query) => $query
                ->where('products.is_active', true)
                ->whereNotNull('products.sale_price')
                ->where('products.sale_price', '>', 0)
                ->whereColumn(
                    'products.sale_price',
                    '<',
                    'products.price'
                )
            )
            ->orderBy('position')
            ->orderBy('starts_at')
            ->get();
    }

    /**
     * Get the current active deal
     * with its discounted products.
     */
    public function current(): ?Deal
    {
        return Deal::query()
            ->with([
                'products' => fn ($query) => $query
                    ->with([
                        'brand',
                        'category',
                        'primaryMedia',
                        'media',
                    ])
                    ->where('products.is_active', true)
                    ->whereNotNull('products.sale_price')
                    ->where('products.sale_price', '>', 0)
                    ->whereColumn(
                        'products.sale_price',
                        '<',
                        'products.price'
                    ),
            ])
            ->where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->whereHas('products', fn ($query) => $query
                ->where('products.is_active', true)
                ->whereNotNull('products.sale_price')
                ->where('products.sale_price', '>', 0)
                ->whereColumn(
                    'products.sale_price',
                    '<',
                    'products.price'
                )
            )
            ->orderBy('position')
            ->orderBy('starts_at')
            ->first();
    }
}