<?php

namespace App\Services\Frontend\Product;

use Illuminate\Database\Eloquent\Builder;

class Filters
{
    public function apply(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                $filters['brands'] ?? [],
                fn (Builder $query, array $brands) =>
                    $query->whereHas(
                        'brand',
                        fn (Builder $query) =>
                            $query->whereIn('slug', $brands)
                    )
            )
            ->when(
                $filters['conditions'] ?? [],
                fn (Builder $query, array $conditions) =>
                    $query->whereIn('condition', $conditions)
            )
            ->when(
                $filters['min_price'] ?? null,
                fn (Builder $query, $price) =>
                    $query->where('price', '>=', $price)
            )
            ->when(
                $filters['max_price'] ?? null,
                fn (Builder $query, $price) =>
                    $query->where('price', '<=', $price)
            )
            ->when(
                $filters['in_stock'] ?? false,
                fn (Builder $query) =>
                    $query->where('stock_quantity', '>', 0)
            );
    }
}