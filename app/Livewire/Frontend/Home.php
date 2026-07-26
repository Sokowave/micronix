<?php

namespace App\Livewire\Frontend;

use App\Services\Frontend\Banner;
use App\Services\Frontend\Category;
use App\Services\Frontend\Product\Featured;
use App\Services\Frontend\Product\NewArrivals;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.frontend')]
#[Title('Micronix')]
class Home extends Component
{
    public function render(
        Banner $banners,
        Category $categories,
        Featured $featuredProducts,
        NewArrivals $latestProducts,
    ): View {
        return view('livewire.frontend.home', [
            // Banners
            'heroCenter' => $banners->homeHeroCenter(),
            'heroLeft' => $banners->homeHeroLeft(),
            'heroRight' => $banners->homeHeroRight(),
            'promoBanners' => $banners->promoBanner(),

            // Categories
            'categories' => $categories->parents(),

            // Products
            'featuredProducts' => $featuredProducts->get(),
            'latestProducts' => $latestProducts->get(),
        ]);
    }
}