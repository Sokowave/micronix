<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Specification;
use Illuminate\Database\Seeder;

class CategorySpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $mappings = [
            'laptops' => [
                'processor',
                'memory',
                'storage',
                'graphics',
                'screen-size',
                'display-resolution',
                'display-type',
                'refresh-rate',
                'touchscreen',
                'operating-system',
                'keyboard',
                'camera',
                'connectivity',
                'bluetooth',
                'ports',
                'battery',
                'weight',
                'dimensions',
                'colour',
                'warranty',
            ],

            'desktop-computers' => [
                'processor',
                'memory',
                'storage',
                'graphics',
                'operating-system',
                'connectivity',
                'bluetooth',
                'ports',
                'power',
                'dimensions',
                'colour',
                'warranty',
            ],

            'computer-monitors' => [
                'screen-size',
                'display-resolution',
                'display-type',
                'refresh-rate',
                'connectivity',
                'ports',
                'power',
                'dimensions',
                'weight',
                'colour',
                'warranty',
            ],

            'printers' => [
                'print-technology',
                'print-speed',
                'paper-size',
                'connectivity',
                'power',
                'dimensions',
                'weight',
                'colour',
                'warranty',
            ],

            'digital-cameras' => [
                'sensor',
                'lens-mount',
                'video-resolution',
                'screen-size',
                'connectivity',
                'battery',
                'weight',
                'dimensions',
                'colour',
                'warranty',
            ],

            'network-devices' => [
                'network',
                'connectivity',
                'ethernet',
                'ports',
                'power',
                'dimensions',
                'warranty',
            ],
        ];

        foreach ($mappings as $categorySlug => $specificationSlugs) {
            $category = Category::where('slug', $categorySlug)->first();

            if (! $category) {
                continue;
            }

            $specifications = Specification::whereIn('slug', $specificationSlugs)
                ->get()
                ->keyBy('slug');

            $sync = [];

            foreach ($specificationSlugs as $position => $slug) {
                $specification = $specifications->get($slug);

                if (! $specification) {
                    continue;
                }

                $sync[$specification->id] = [
                    'position' => $position + 1,
                ];
            }

            $category->specifications()->sync($sync);
        }
    }
}