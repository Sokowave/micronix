<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagService
{
    /**
     * Sync tags to a product.
     */
    public function sync(Product $product, ?string $tags): void
    {
        if (blank($tags)) {
            $product->tags()->detach();

            return;
        }

        $tagIds = $this->getTagIds($tags);

        $product->tags()->sync($tagIds);
    }

    /**
     * Convert a comma-separated string into tag IDs.
     */
    protected function getTagIds(string $tags): Collection
    {
        return collect(explode(',', $tags))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique()
            ->map(function (string $tag) {
                $name = Str::title($tag);

                return Tag::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name]
                )->id;
            })
            ->values();
    }
}