<?php

namespace App\Services\Frontend;

use App\Models\Banner as BannerModel;
use Illuminate\Database\Eloquent\Collection;

class Banner
{
    /**
     * Get active banners by location.
     */
    public function get(string $location): Collection
    {
        return BannerModel::query()
            ->with('media')
            ->where('location', $location)
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
    }

    public function homeHeroCenter(): Collection
    {
        return $this->get('home_hero_center');
    }

    public function homeHeroLeft(): Collection
    {
        return $this->get('home_hero_left');
    }

    public function homeHeroRight(): Collection
    {
        return $this->get('home_hero_right');
    }

    public function promoBanner(): Collection
    {
        return $this->get('promo_banner');
    }

    public function categorySections(): Collection
    {
        return $this->get('home_category_sections');
    }
}