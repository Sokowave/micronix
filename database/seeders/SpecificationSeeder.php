<?php

namespace Database\Seeders;

use App\Models\Specification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $specifications = [
            ['name' => 'Processor', 'icon' => 'cpu-chip'],
            ['name' => 'Memory', 'icon' => 'circle-stack'],
            ['name' => 'Storage', 'icon' => 'circle-stack'],
            ['name' => 'Graphics', 'icon' => 'rectangle-stack'],
            ['name' => 'Operating System', 'icon' => 'window'],
            ['name' => 'Screen Size', 'icon' => 'computer-desktop'],
            ['name' => 'Display Resolution', 'icon' => 'computer-desktop'],
            ['name' => 'Display Type', 'icon' => 'computer-desktop'],
            ['name' => 'Refresh Rate', 'icon' => 'arrow-path'],
            ['name' => 'Touchscreen', 'icon' => 'cursor-arrow-rays'],
            ['name' => 'Keyboard', 'icon' => 'computer-desktop'],
            ['name' => 'Camera', 'icon' => 'camera'],
            ['name' => 'Connectivity', 'icon' => 'wifi'],
            ['name' => 'Bluetooth', 'icon' => 'signal'],
            ['name' => 'Ports', 'icon' => 'square-3-stack-3d'],
            ['name' => 'Battery', 'icon' => 'battery-100'],
            ['name' => 'Power', 'icon' => 'bolt'],
            ['name' => 'Colour', 'icon' => 'swatch'],
            ['name' => 'Weight', 'icon' => 'scale'],
            ['name' => 'Dimensions', 'icon' => 'arrows-pointing-out'],
            ['name' => 'Material', 'icon' => 'cube'],
            ['name' => 'Network', 'icon' => 'globe-alt'],
            ['name' => 'Ethernet', 'icon' => 'signal'],
            ['name' => 'Print Technology', 'icon' => 'printer'],
            ['name' => 'Print Speed', 'icon' => 'printer'],
            ['name' => 'Paper Size', 'icon' => 'document'],
            ['name' => 'Sensor', 'icon' => 'camera'],
            ['name' => 'Lens Mount', 'icon' => 'camera'],
            ['name' => 'Video Resolution', 'icon' => 'video-camera'],
            ['name' => 'Warranty', 'icon' => 'shield-check'],
        ];

        foreach ($specifications as $specification) {
            Specification::updateOrCreate(
                [
                    'slug' => Str::slug($specification['name']),
                ],
                [
                    'name' => $specification['name'],
                    'icon' => $specification['icon'],
                ]
            );
        }
    }
}