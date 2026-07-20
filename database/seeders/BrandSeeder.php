<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [

            [
                'name' => 'Apple',
                'meta_title' => 'Apple Accessories',
                'meta_description' => 'Apple accessories and compatible products.',
            ],

            [
                'name' => 'Samsung',
                'meta_title' => 'Samsung Accessories',
                'meta_description' => 'Samsung accessories and consumer electronics.',
            ],

            [
                'name' => 'Anker',
                'meta_title' => 'Anker Charging Accessories',
                'meta_description' => 'Premium chargers, power banks and USB accessories.',
            ],

            [
                'name' => 'UGREEN',
                'meta_title' => 'UGREEN Accessories',
                'meta_description' => 'Quality cables, hubs and connectivity accessories.',
            ],

            [
                'name' => 'Logitech',
                'meta_title' => 'Logitech Computer Accessories',
                'meta_description' => 'Keyboards, mice, webcams and productivity accessories.',
            ],

            [
                'name' => 'HP',
                'meta_title' => 'HP Computing',
                'meta_description' => 'HP laptops, monitors and computer accessories.',
            ],

            [
                'name' => 'Dell',
                'meta_title' => 'Dell Computing',
                'meta_description' => 'Dell laptops, desktops and monitors.',
            ],

            [
                'name' => 'Lenovo',
                'meta_title' => 'Lenovo Computing',
                'meta_description' => 'Lenovo laptops and computer accessories.',
            ],

            [
                'name' => 'Kingston',
                'meta_title' => 'Kingston Storage',
                'meta_description' => 'Memory cards, SSDs and flash drives.',
            ],

            [
                'name' => 'SanDisk',
                'meta_title' => 'SanDisk Storage',
                'meta_description' => 'Reliable storage devices and memory solutions.',
            ],

            [
                'name' => 'TP-Link',
                'meta_title' => 'TP-Link Networking',
                'meta_description' => 'Networking equipment including routers and switches.',
            ],

            [
                'name' => 'JBL',
                'meta_title' => 'JBL Audio',
                'meta_description' => 'Bluetooth speakers and premium audio accessories.',
            ],

            [
                'name' => 'Sony',
                'meta_title' => 'Sony Electronics',
                'meta_description' => 'Headphones, speakers and consumer electronics.',
            ],

            [
                'name' => 'Oraimo',
                'meta_title' => 'Oraimo Accessories',
                'meta_description' => 'Smart accessories, chargers and audio devices.',
            ],

            [
                'name' => 'Xiaomi',
                'meta_title' => 'Xiaomi Accessories',
                'meta_description' => 'Smart devices and mobile accessories.',
            ],

        ];
        foreach ($brands as $brand) {
            $slug = Str::slug($brand['name']);

            $media = Media::create([
                'public_id' => (string) Str::ulid(),
                'disk' => 'public',
                'folder' => 'brands',
                'path' => "brands/{$slug}.png",
            ]);

            Brand::updateOrCreate(
                ['name' => $brand['name']],
                [
                    'slug' => $slug,
                    'logo_id' => $media->id,
                    'meta_title' => $brand['meta_title'],
                    'meta_description' => $brand['meta_description'],
                    'status' => 'active',
                ]
            );
        }
    }
}