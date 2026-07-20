<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ProductListing\ProductListingService;
use Illuminate\Http\Request;

class ProductListingController extends Controller
{
    public function __construct(
        protected ProductListingService $listing,
    ) {}

    /**
     * Display all published products.
     */
    public function index(Request $request)
    {
        return view(
            'frontend.product_listing',
            $this->listing->handle($request)
        );
    }

    /**
     * Display products for a category.
     */
    public function category(
        Request $request,
        Category $category,
    ) {
        return view(
            'frontend.product_listing',
            $this->listing->handle($request, $category)
        );
    }
}