<?php

namespace App\Services\Products;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    public function apply(Builder $query): Builder
    {
        return $query
            ->when(
                request('search'),
                fn (Builder $query, string $search) => $query->where(function (Builder $query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                })
            )

            ->when(
                request('category'),
                fn (Builder $query, $category) => $query->where('category_id', $category)
            )

            ->when(
                request('brand'),
                fn (Builder $query, $brand) => $query->where('brand_id', $brand)
            )

            ->when(
                request('status'),
                fn (Builder $query, $status) => $query->where('status', $status)
            )

            ->when(
                request()->filled('featured'),
                fn (Builder $query) => $query->where(
                    'featured',
                    request()->boolean('featured')
                )
            )

            ->tap(function (Builder $query) {

                match (request('sort')) {

                    'oldest' => $query->oldest(),

                    'title' => $query->orderBy('title'),

                    'price_low' => $query->orderBy('price'),

                    'price_high' => $query->orderByDesc('price'),

                    default => $query->latest(),

                };

            });
    }
}