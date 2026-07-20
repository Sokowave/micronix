<?php

namespace App\Services\ProductListing\Support;

use App\Models\Category;
use Illuminate\Support\Collection;

class ChildCategories
{
    /**
     * Get child categories that contain published products.
     */
    public function get(?Category $category): Collection
    {
        if (! $category) {
            return collect();
        }

        return $category->children
            ->filter(fn (Category $child) => $this->hasPublishedProducts($child))
            ->values();
    }

    /**
     * Determine whether a category or any of its descendants
     * has published products.
     */
    protected function hasPublishedProducts(Category $category): bool
    {
        if ($category->publishedProducts()->exists()) {
            return true;
        }

        foreach ($category->children as $child) {
            if ($this->hasPublishedProducts($child)) {
                return true;
            }
        }

        return false;
    }
}