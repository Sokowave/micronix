<?php

namespace App\Services\ProductListing\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery
{
    /**
     * Create the base product query.
     */
    public function make(): Builder
    {
        return Product::query()
            ->published()
            ->with([
                'brand',
                'category.parent',
                'images',
                'tags',
            ]);
    }
}