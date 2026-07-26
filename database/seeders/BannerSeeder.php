<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Media;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [

            /*
            |--------------------------------------------------------------------------
            | Home Hero Left
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Home Hero Left 1',
                'location' => 'home_hero_left',
                'position' => 1,
                'path' => 'banners/left1.png',
            ],
            [
                'title' => 'Home Hero Left 2',
                'location' => 'home_hero_left',
                'position' => 2,
                'path' => 'banners/left2.png',
            ],
            [
                'title' => 'Home Hero Left 3',
                'location' => 'home_hero_left',
                'position' => 3,
                'path' => 'banners/left3.png',
            ],

            /*
            |--------------------------------------------------------------------------
            | Home Hero Center
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Home Hero Center 1',
                'location' => 'home_hero_center',
                'position' => 1,
                'path' => 'banners/center1.png',
            ],
            [
                'title' => 'Home Hero Center 2',
                'location' => 'home_hero_center',
                'position' => 2,
                'path' => 'banners/center2.png',
            ],
            [
                'title' => 'Home Hero Center 3',
                'location' => 'home_hero_center',
                'position' => 3,
                'path' => 'banners/center3.png',
            ],

            /*
            |--------------------------------------------------------------------------
            | Home Hero Right
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Home Hero Right 1',
                'location' => 'home_hero_right',
                'position' => 1,
                'path' => 'banners/right1.png',
            ],
            [
                'title' => 'Home Hero Right 2',
                'location' => 'home_hero_right',
                'position' => 2,
                'path' => 'banners/right2.png',
            ],
            [
                'title' => 'Home Hero Right 3',
                'location' => 'home_hero_right',
                'position' => 3,
                'path' => 'banners/right3.png',
            ],
        ];

        foreach ($banners as $banner) {
            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */

            $media = Media::updateOrCreate(
                [
                    'disk' => 'public',
                    'path' => $banner['path'],
                ],
                [
                    'file_name' => basename($banner['path']),
                    'file_id' => null,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Banner
            |--------------------------------------------------------------------------
            */

            Banner::updateOrCreate(
                [
                    'location' => $banner['location'],
                    'position' => $banner['position'],
                ],
                [
                    'media_id' => $media->id,
                    'title' => $banner['title'],
                    'is_active' => true,
                ]
            );
        }

        $this->command?->info('9 banners seeded successfully.');
    }
}