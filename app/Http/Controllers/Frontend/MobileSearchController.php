<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Lib\Categories\HomepageCategories;
use App\Lib\Products\NewArrivals;
use App\Services\SearchService;
use Illuminate\View\View;

class MobileSearchController extends Controller
{
    public function __construct(
        protected SearchService $searchService
    ) {}

    public function index(): View
    {
        return view('frontend.search.index', [
            'recentSearches' => $this->searchService->all(),

            'categories' => HomepageCategories::get(
                limit: 6,
                random: true
            ),

            'products' => NewArrivals::get(12),
        ]);
    }

    public function destroy(string $query)
    {
        $this->searchService->remove(
            urldecode($query)
        );

        return back();
    }

    public function clear()
    {
        $this->searchService->clear();

        return back();
    }
}