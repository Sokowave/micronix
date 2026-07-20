<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('backend.dashboard.index', [

            /*
            |--------------------------------------------------------------------------
            | Main Statistics
            |--------------------------------------------------------------------------
            */

            'productsCount' => Product::count(),

            'categoriesCount' => Category::count(),

            'brandsCount' => Brand::count(),

            'usersCount' => User::count(),

            /*
            |--------------------------------------------------------------------------
            | Store Overview
            |--------------------------------------------------------------------------
            */

            'publishedProducts' => Product::published()->count(),

            'draftProducts' => Product::draft()->count(),

            'featuredProducts' => Product::featured()->count(),

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            'pagesCount' => Page::published()->count(),

            'testimonialsCount' => Testimonial::active()->count(),

            'activeBrands' => Brand::where('status', 'active')->count(),

            'activeCategories' => Category::where('is_active', true)->count(),
        ]);
    }
}