<?php

namespace App\Services\Home;

use App\Data\BannerData;
use App\Models\Banner;

class HeroBannerService
{
    /**
     * Get hero banners.
     *
     * @return \Illuminate\Support\Collection<int, BannerData>
     */
    public function get()
    {
        return BannerData::collect(
            Banner::query()
                ->location('hero')
                ->active()
                ->ordered()
                ->with('media')
                ->get()
        );
    }
}