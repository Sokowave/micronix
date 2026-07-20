<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Home\HeroBannerService;
use App\Services\Home\HeroCategoryService;
use App\Lib\Categories\HomepageCategories;
use App\Lib\Products\FeaturedProducts;
use App\Lib\Products\HeroProducts;
use App\Lib\Products\MoreToLove;
use App\Lib\Products\NewArrivals;
use App\Lib\Testimonials\Testimonials;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(
        HeroCategoryService $heroCategoryService,
        HeroBannerService $heroBannerService,
    ): Response
    {
        return Inertia::render('Home', [
            'heroCategories' => $heroCategoryService->get(12),
            'banners' => $heroBannerService->get(),

            'heroProducts' => HeroProducts::get(24),
            'products' => NewArrivals::get(12),
            'featuredProducts' => FeaturedProducts::get(12),
            'moreToLoveProducts' => MoreToLove::get(24),
            'testimonials' => Testimonials::get(),

            'featuredCategories' => HomepageCategories::get(
                limit: 12,
                orderBy: 'products'
            ),

            'homepageCategories' => HomepageCategories::get(
                limit: 6,
                random: true
            ),
        ]);
    }
}