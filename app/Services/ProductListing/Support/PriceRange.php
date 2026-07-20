<?php

namespace App\Services\ProductListing\Support;

use Illuminate\Database\Eloquent\Builder;

class PriceRange
{
    /**
     * Calculate the available price range for the current query.
     */
    public function calculate(Builder $query): array
    {
        $products = $query->get();

        return [
            'min' => $products->min('current_price') ?? 0,
            'max' => $products->max('current_price') ?? 0,
        ];
    }
}