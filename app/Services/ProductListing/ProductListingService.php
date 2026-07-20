<?php

namespace App\Services\ProductListing;

use App\Models\Category;
use App\Services\ProductListing\Builders\ViewDataBuilder;
use App\Services\ProductListing\Filters\BrandFilter;
use App\Services\ProductListing\Filters\CategoryFilter;
use App\Services\ProductListing\Filters\PriceFilter;
use App\Services\ProductListing\Filters\SearchFilter;
use App\Services\ProductListing\Filters\SortFilter;
use App\Services\ProductListing\Queries\ProductQuery;
use App\Services\ProductListing\Support\ChildCategories;
use App\Services\ProductListing\Support\PriceRange;
use App\Services\ProductListing\Support\Brands;
use Illuminate\Http\Request;

class ProductListingService
{
    public function __construct(
        protected ProductQuery $productQuery,
        protected CategoryFilter $categoryFilter,
        protected BrandFilter $brandFilter,
        protected SearchFilter $searchFilter,
        protected PriceFilter $priceFilter,
        protected SortFilter $sortFilter,
        protected PriceRange $priceRange,
        protected ChildCategories $childCategories,
        protected ViewDataBuilder $viewData,
        protected Brands $brands,
    ) {}

    /**
     * Build the product listing.
     */
    public function handle(
        Request $request,
        ?Category $category = null,
    ): array {
        $query = $this->productQuery->make();

        // Apply category filter
        $this->categoryFilter->apply($query, $category);

        // Apply request filters
        $this->searchFilter->apply($query, $request);
        $this->brandFilter->apply($query, $request);
        $this->priceFilter->apply($query, $request);

        // Calculate price range before sorting/pagination
        $priceRange = $this->priceRange->calculate(clone $query);

        // Apply sorting
        $this->sortFilter->apply($query, $request);

        $brands = $this->brands->get($category);

        // Paginate
        $products = $query
            ->paginate(24)
            ->appends($request->query());

        return $this->viewData->build(
            request: $request,
            products: $products,
            category: $category,
            priceRange: $priceRange,
            extra: [
                'brands' => $brands,
                'childCategories' => $this->childCategories->get($category),
            ],
        );
    }
}