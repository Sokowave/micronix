<?php

namespace App\Services\ProductListing\Builders;

use App\Models\Category;
use App\Services\ProductListing\Filters\SortFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ViewDataBuilder
{
    public function __construct(
        protected SortFilter $sortFilter,
    ) {}

    /**
     * Build the data passed to the product listing view.
     */
    public function build(
        Request $request,
        LengthAwarePaginator $products,
        ?Category $category = null,
        array $priceRange = [],
        array $extra = [],
    ): array {
        $sort = $this->sortFilter->current($request);

        return array_merge([
            /*
            |--------------------------------------------------------------------------
            | Listing
            |--------------------------------------------------------------------------
            */

            'products' => $products,

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            'category' => $category,
            'breadcrumbs' => $category?->getBreadcrumbs(),
            'brands' => collect(),
            'selectedBrand' => $request->input('brand'),
            'childCategories' => collect(),

            /*
            |--------------------------------------------------------------------------
            | Search & Filters
            |--------------------------------------------------------------------------
            */

            'query' => trim($request->input('q', '')),
            'selectedBrand' => $request->input('brand'),

            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),

            /*
            |--------------------------------------------------------------------------
            | Price Range
            |--------------------------------------------------------------------------
            */

            'min_price_default' => $priceRange['min'] ?? 0,
            'max_price_default' => $priceRange['max'] ?? 0,

            /*
            |--------------------------------------------------------------------------
            | Sorting
            |--------------------------------------------------------------------------
            */

            'sort' => $sort,
            'sortLabel' => $this->sortFilter->label($request),
            'sortOptions' => $this->sortFilter->options(),


        ], $extra);
    }
}