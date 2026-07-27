<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CollectionProductSeeder extends Seeder
{
    public function run(): void
    {
        Collection::query()
            ->where('is_active', true)
            ->each(function (Collection $collection): void {
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

                $collection->products()->sync($syncData);
            });
    }
}