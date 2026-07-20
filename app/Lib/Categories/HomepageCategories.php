<?php

namespace App\Lib\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;

class HomepageCategories
{
    /**
     * Get homepage parent categories.
     *
     * Supported ordering:
     * - name
     * - products
     *
     * Set $random to true to return a random collection.
     */
    public static function get(
        int $limit = 18,
        string $orderBy = 'name',
        bool $random = false
    ): Collection {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with([
                'image',
                'publishedProducts',
                'childrenRecursive.image',
                'childrenRecursive.publishedProducts',
            ])
            ->orderBy('name')
            ->get()
            ->filter(fn (Category $category) => CategoryProductCounter::hasPublishedProducts($category))
            ->values();

        $categories->each(function (Category $category) {
            $category->total_published_products = CategoryProductCounter::count($category);
        });

        $categories = match ($orderBy) {
            'products' => $categories
                ->sortByDesc('total_published_products')
                ->values(),

            default => $categories
                ->sortBy('name')
                ->values(),
        };

        if ($random) {
            $categories = $categories
                ->shuffle()
                ->values();
        }

        return $categories
            ->take($limit)
            ->values();
    }
}