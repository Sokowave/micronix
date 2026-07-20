<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Services\Media\MediaUploaderService;

class ProductMediaService
{
    public function __construct(
        protected MediaUploaderService $mediaUploader,
    ) {
    }

    /**
     * Handle all product media.
     */
    public function handle(
        Product $product,
        array $data
    ): Product {

        DB::transaction(function () use ($product, $data) {

            $this->attachExistingMedia(
                $product,
                $data['existing_media'] ?? []
            );

            $this->uploadGalleryImages(
                $product,
                $data['images'] ?? []
            );
        });

        return $product->refresh();
    }

    /**
     * Upload new gallery images.
     */
    protected function uploadGalleryImages(
        Product $product,
        array $images
    ): void {

        if (empty($images)) {
            return;
        }

        $sortOrder = $product->productImages()
            ->max('sort_order') ?? -1;

        foreach ($images as $image) {

            if (! $image) {
                continue;
            }

            $media = $this->mediaUploader->upload(
                $image,
                'products'
            );

            if (
                $product->productImages()
                    ->where('media_id', $media->id)
                    ->exists()
            ) {
                continue;
            }

            $product->productImages()->create([
                'media_id'   => $media->id,
                'sort_order' => ++$sortOrder,
            ]);
        }
    }

    /**
     * Attach existing media to the product.
     */
    protected function attachExistingMedia(
        Product $product,
        array $mediaIds
    ): void {

        if (empty($mediaIds)) {
            return;
        }

        $sortOrder = $product->productImages()
            ->max('sort_order') ?? -1;

        foreach ($mediaIds as $mediaId) {

            if (
                $product->productImages()
                    ->where('media_id', $mediaId)
                    ->exists()
            ) {
                continue;
            }

            $product->productImages()->create([
                'media_id'   => $mediaId,
                'sort_order' => ++$sortOrder,
            ]);
        }
    }
}