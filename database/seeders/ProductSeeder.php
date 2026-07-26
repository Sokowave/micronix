<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = config('products', []);

        if (empty($products)) {
            $this->command?->warn('No products found in config/products.php.');

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Existing Leaf Categories
        |--------------------------------------------------------------------------
        |
        | Only categories that do not have child categories are eligible.
        |
        */

        $categories = Category::query()
            ->whereDoesntHave('children')
            ->pluck('id');

        if ($categories->isEmpty()) {
            $this->command?->error(
                'No leaf categories found. Seed categories before products.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Existing Brands
        |--------------------------------------------------------------------------
        */

        $brands = Brand::query()
            ->pluck('id');

        if ($brands->isEmpty()) {
            $this->command?->error(
                'No brands found. Seed brands before products.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Existing Specifications
        |--------------------------------------------------------------------------
        */

        $specifications = Specification::query()
            ->pluck('id', 'slug');

        /*
        |--------------------------------------------------------------------------
        | Product Images
        |--------------------------------------------------------------------------
        */

        $productImages = collect(
            glob(
                public_path(
                    'media/products/*.{jpg,jpeg,png,webp,gif,avif,JPG,JPEG,PNG,WEBP,GIF,AVIF}'
                ),
                GLOB_BRACE
            ) ?: []
        )
            ->shuffle()
            ->values();

        $imageIndex = 0;
        $imageCount = $productImages->count();

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        foreach ($products as $data) {
            $categoryId = $categories->random();
            $brandId = $brands->random();

            /*
            |--------------------------------------------------------------------------
            | Create / Update Product
            |--------------------------------------------------------------------------
            */

            $product = Product::updateOrCreate(
                [
                    'name' => $data['name'],
                ],
                [
                    'category_id' => $categoryId,
                    'brand_id' => $brandId,
                    'price' => $data['price'],
                    'sale_price' => $data['sale_price'] ?? null,
                    'stock_quantity' => $data['stock_quantity'] ?? 0,
                    'condition' => $data['condition'] ?? 'new',
                    'warranty' => $data['warranty'] ?? null,
                    'short_description' => $data['short_description'] ?? null,
                    'description' => $data['description'] ?? null,
                    'meta_title' => $data['meta_title'] ?? $data['name'],
                    'meta_description' => $data['meta_description'] ?? null,
                    'is_featured' => $data['is_featured'] ?? false,
                    'is_active' => $data['is_active'] ?? true,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Product Media
            |--------------------------------------------------------------------------
            */

            $this->syncMedia(
                $product,
                $productImages,
                $imageIndex,
                $imageCount
            );

            /*
            |--------------------------------------------------------------------------
            | Product Specifications
            |--------------------------------------------------------------------------
            */

            $this->syncSpecifications(
                $product,
                $data,
                $specifications
            );

            /*
            |--------------------------------------------------------------------------
            | Product Tags
            |--------------------------------------------------------------------------
            */

            $this->syncTags(
                $product,
                $data
            );
        }

        $this->command?->info(
            count($products).' products seeded successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Product Media
    |--------------------------------------------------------------------------
    */

    private function syncMedia(
        Product $product,
        Collection $productImages,
        int &$imageIndex,
        int $imageCount
    ): void {
        if ($imageCount === 0) {
            return;
        }

        $selectedImages = collect();

        $imagesPerProduct = min(8, $imageCount);

        for ($i = 0; $i < $imagesPerProduct; $i++) {
            $selectedImages->push(
                $productImages[$imageIndex % $imageCount]
            );

            $imageIndex++;
        }

        $mediaSync = [];

        foreach ($selectedImages as $index => $imagePath) {
            $fileName = basename($imagePath);
            $relativePath = 'products/'.$fileName;

            $media = Media::updateOrCreate(
                [
                    'disk' => 'public',
                    'path' => $relativePath,
                ],
                [
                    'file_name' => $fileName,
                    'file_id' => null,
                ]
            );

            $mediaSync[$media->id] = [
                'is_primary' => $index === 0,
                'position' => $index + 1,
            ];
        }

        $product->media()->sync($mediaSync);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Product Specifications
    |--------------------------------------------------------------------------
    */

    private function syncSpecifications(
        Product $product,
        array $data,
        Collection $specifications
    ): void {
        $productSpecifications = [];

        foreach ($data['specifications'] ?? [] as $slug => $value) {
            $specificationId = $specifications->get($slug);

            if (! $specificationId) {
                $this->command?->warn(
                    "Specification [{$slug}] not found for [{$data['name']}]."
                );

                continue;
            }

            $productSpecifications[$specificationId] = [
                'value' => $value,
            ];
        }

        $product->specifications()->sync(
            $productSpecifications
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Product Tags
    |--------------------------------------------------------------------------
    */

    private function syncTags(
        Product $product,
        array $data
    ): void {
        $tagIds = collect($data['tags'] ?? [])
            ->map(
                fn (string $name): int => Tag::firstOrCreate(
                    [
                        'slug' => Str::slug($name),
                    ],
                    [
                        'name' => $name,
                    ]
                )->id
            );

        $product->tags()->sync($tagIds);
    }
}