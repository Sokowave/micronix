<?php

namespace App\Livewire\Frontend;

use App\Services\Frontend\Banner;
use App\Services\Frontend\Category;
use App\Services\Collection\Index as CollectionIndex;
use App\Services\Deals\Index as DealIndex;
use App\Services\Frontend\Product\Featured;
use App\Services\Frontend\Product\NewArrivals;
use App\Services\Frontend\Product\CategorySections;
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
        CollectionIndex $collections,
        DealIndex $deals,
        Category $categories,
        Featured $featuredProducts,
        NewArrivals $latestProducts,
        CategorySections $categorySections,
    ): View {
        return view('livewire.frontend.home', [
            // Banners
            'heroCenter' => $banners->homeHeroCenter(),
            'heroLeft' => $banners->homeHeroLeft(),
            'heroRight' => $banners->homeHeroRight(),
            'promoBanners' => $banners->promoBanner(),
            'categoryBanners' => $banners->categorySections(),
            'collections' => $collections->get(),

            // Categories
            'categories' => $categories->parents(),

            'deal' => $deals->current(),

            // Products
            'featuredProducts' => $featuredProducts->get(),
            'latestProducts' => $latestProducts->get(),

            'categorySections' => $categorySections->get(),
        ]);
    }
}