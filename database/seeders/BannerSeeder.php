<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [

            [
                'title' => 'Category Deals',
                'image' => 'https://ke.jumia.is/cms/2026/W15/FS/KE_ONS_BHM_FS_0426_S.gif',
                'location' => 'hero',
                'priority' => 10,
                'target_type' => 'category',
                'target_id' => 1,
            ],

            [
                'title' => 'Beauty Deals',
                'image' => 'https://ke.jumia.is/cms/2026/W16/KE_ONS_BeautyDay_0426_S.gif',
                'location' => 'hero',
                'priority' => 9,
                'target_type' => 'category',
                'target_id' => 1,
            ],

            [
                'title' => 'Back to School',
                'image' => 'https://ke.jumia.is/cms/2026/W16/B2S/KE_ONS_B2S_Generic_0426_S.jpg',
                'location' => 'hero',
                'priority' => 8,
                'target_type' => 'product',
                'target_id' => 1,
            ],

            [
                'title' => 'Nice & Lovely Promo',
                'image' => 'https://ke.jumia.is/cms/2026/SIS/Nice&Lovely/W17/712x384.gif',
                'location' => 'hero',
                'priority' => 7,
                'target_type' => 'brand',
                'target_id' => 1,
            ],

            [
                'title' => 'TV Deals',
                'image' => 'https://ke.jumia.is/cms/2026/W16/S/KE_ONS_BHM_TVs_0426_S.gif',
                'location' => 'hero',
                'priority' => 6,
                'target_type' => 'product',
                'target_id' => 1,
            ],
        ];

        foreach ($banners as $item) {

            $media = Media::create([
                'public_id' => (string) Str::ulid(),
                'disk' => 'external',
                'folder' => 'banners',
                'path' => $item['image'],
                'url' => $item['image'],
            ]);

            Banner::create([
                'location' => $item['location'],
                'media_id' => $media->id,
                'title' => $item['title'],

                'target_type' => $item['target_type'],
                'target_id' => $item['target_id'],
                'custom_url' => null,

                'priority' => $item['priority'],
                'is_active' => true,
            ]);
        }
    }
}