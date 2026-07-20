<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Fields handled by other services.
     */
    protected array $excludedFields = [
        'tags',
        'images',
        'sort_orders',
        'main_media_id',
        'remove_media_ids',
    ];

    /**
     * Fields used by the media service.
     */
    protected array $mediaFields = [
        'images',
        'sort_orders',
        'main_media_id',
        'remove_media_ids',
    ];

    public function __construct(
        protected TagService $tagService,
        protected ProductMediaService $productMediaService,
    ) {
    }

    /**
     * Create a product.
     */
    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data): Product {

            $product = Product::create(
                $this->extractProductData($data)
            );

            $this->syncRelations($product, $data);

            return $product->refresh();
        });
    }

    /**
     * Update a product.
     */
    public function update(
        Product $product,
        array $data
    ): Product {
        return DB::transaction(function () use ($product, $data): Product {

            $product->update(
                $this->extractProductData($data)
            );

            $this->syncRelations($product, $data);

            return $product->refresh();
        });
    }

    /**
     * Delete a product.
     */
    public function delete(Product $product): void
    {
        DB::transaction(function () use ($product): void {

            $product->tags()->detach();

            // Optional:
            // Delete Media records if they are not shared elsewhere.

            $product->productImages()->delete();

            $product->delete();
        });
    }

    /**
     * Synchronize all product relationships.
     */
    protected function syncRelations(
        Product $product,
        array $data
    ): void {

        $this->tagService->sync(
            $product,
            $data['tags'] ?? null
        );

        $this->productMediaService->handle(
            $product,
            $this->extractMediaData($data)
        );
    }

    /**
     * Extract product attributes.
     */
    protected function extractProductData(array $data): array
    {
        return Arr::except(
            $data,
            $this->excludedFields
        );
    }

    /**
     * Extract media payload.
     */
    protected function extractMediaData(array $data): array
    {
        return [
            'images' => $data['images'] ?? [],
            'sort_orders' => $data['sort_orders'] ?? [],
            'main_media_id' => $data['main_media_id'] ?? null,
            'remove_media_ids' => $data['remove_media_ids'] ?? [],
        ];
    }
}