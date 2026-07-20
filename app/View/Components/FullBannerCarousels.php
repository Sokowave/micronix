<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Banner;
use App\Models\BannerLocation;

class FullBannerCarousels extends Component
{
    public $banners;

    public function __construct()
    {
        // Get the location for full banner carousel
        $locationId = cache()->remember('banner_location_full_carousel', 3600, function () {
            return BannerLocation::byKey('full_banner_carousels')->value('id');
        });

        $this->banners = $locationId
            ? Banner::query()
                ->forLocation($locationId)
                ->active()
                ->validNow()
                ->with('targets')
                ->ordered()
                ->take(8)
                ->get()
            : collect();
    }

    public function render()
    {
        return view('components.full-banner-carousels');
    }
}