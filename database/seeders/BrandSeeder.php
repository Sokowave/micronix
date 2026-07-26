<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Acer',
            'Asus',
            'Canon',
            'Dell',
            'Epson',
            'HP',
            'Huawei',
            'Lenovo',
            'Logitech',
            'Microsoft',
            'MSI',
            'Samsung',
            'TP-Link',
        ];

        foreach ($brands as $position => $name) {
            Brand::updateOrCreate(
                [
                    'slug' => Str::slug($name),
                ],
                [
                    'media_id' => null,
                    'name' => $name,
                    'description' => null,
                    'meta_title' => $name.' Products',
                    'meta_description' => null,
                    'is_active' => true,
                    'position' => $position + 1,
                ]
            );
        }
    }
}