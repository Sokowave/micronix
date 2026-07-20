<?php

namespace App\Services\ProductListing\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PriceFilter
{
    /**
     * Apply the price filter.
     */
    public function apply(Builder $query, Request $request): void
    {
        if ($request->filled('min_price')) {
            $min = (float) $request->input('min_price');

            $query->where(function (Builder $query) use ($min) {
                $query->where('price', '>=', $min)
                    ->orWhere('sale_price', '>=', $min);
            });
        }

        if ($request->filled('max_price')) {
            $max = (float) $request->input('max_price');

            $query->where(function (Builder $query) use ($max) {
                $query->where('price', '<=', $max)
                    ->orWhere('sale_price', '<=', $max);
            });
        }
    }
}