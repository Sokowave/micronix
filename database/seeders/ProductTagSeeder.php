<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::all();

        if ($tags->isEmpty()) {
            return;
        }

        Product::all()->each(function ($product) use ($tags) {

            $randomTags = $tags->random(rand(1, 3))->pluck('id')->toArray();

            $product->tags()->syncWithoutDetaching($randomTags);
        });
    }
}