<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DealSeeder extends Seeder
{
    public function run(): void
    {
        $deals = [
            [
                'name' => 'Deal of the Day',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()->endOfDay(),
                'position' => 1,
            ],
            [
                'name' => 'Flash Sale',
                'starts_at' => now(),
                'ends_at' => now()->addDays(3)->endOfDay(),
                'position' => 2,
            ],
            [
                'name' => 'Weekend Deals',
                'starts_at' => now(),
                'ends_at' => now()->addDays(7)->endOfDay(),
                'position' => 3,
            ],
        ];

        foreach ($deals as $data) {
            $deal = Deal::query()->updateOrCreate(
                [
                    'slug' => Str::slug($data['name']),
                ],
                [
                    'name' => $data['name'],
                    'starts_at' => $data['starts_at'],
                    'ends_at' => $data['ends_at'],
                    'is_active' => true,
                    'position' => $data['position'],
                ]
            );

            $productIds = Product::query()
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit(12)
                ->pluck('id');

            $syncData = $productIds
                ->values()
                ->mapWithKeys(
                    fn ($productId, $index) => [
                        $productId => [
                            'position' => $index + 1,
                        ],
                    ]
                )
                ->all();

            $deal->products()->sync($syncData);
        }
    }
}