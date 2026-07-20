<?php

namespace App\Services\ProductListing\Filters;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BrandFilter
{
    /**
     * Apply the brand filter to the query.
     */
    public function apply(Builder $query, Request $request): void
    {
        $slug = $request->string('brand')->toString();

        if (blank($slug)) {
            return;
        }

        $brand = Brand::query()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if (! $brand) {
            return;
        }

        $query->where('brand_id', $brand->id);
    }
}