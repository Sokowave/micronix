<?php

namespace App\Services\ProductListing\Filters;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter
{
    /**
     * Apply the category filter.
     */
    public function apply(Builder $query, ?Category $category): void
    {
        if (! $category) {
            return;
        }

        $query->whereIn(
            'category_id',
            $category->descendantIds()
        );
    }
}