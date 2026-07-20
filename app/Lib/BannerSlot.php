<?php

namespace App\Lib;

use App\Models\Banner;
use App\Models\BannerLocation;
use Illuminate\Database\Eloquent\Collection;

class BannerSlot
{
    public static function location(string $key): ?BannerLocation
    {
        return BannerLocation::query()
            ->byKey($key)
            ->first();
    }

    public static function banners(string $key): Collection
    {
        $location = static::location($key);

        return Banner::query()
            ->where('banner_location_id', $location?->id)
            ->active()
            ->validNow()
            ->with([
                'location',
                'media',
                'targets.category',
                'targets.product',
                'targets.brand',
            ])
            ->ordered()
            ->get();
    }

    public static function banner(string $key): ?Banner
    {
        return static::banners($key)->first();
    }

    public static function data(string $key): array
    {
        $location = static::location($key);

        return [
            'location' => $location,
            'banners' => static::banners($key),
        ];
    }
}