<?php

namespace App\Lib\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryTree
{
    /**
     * Flatten a category and all its descendants.
     */
    public static function flatten(Category $category): Collection
    {
        $categories = collect([$category]);

        foreach ($category->childrenRecursive as $child) {
            $categories = $categories->merge(
                self::flatten($child)
            );
        }

        return $categories;
    }

    /**
     * Get all descendants of a category.
     */
    public static function descendants(Category $category): Collection
    {
        return self::flatten($category)
            ->reject(fn (Category $item) => $item->is($category))
            ->values();
    }

    /**
     * Determine whether the category has descendants.
     */
    public static function hasDescendants(Category $category): bool
    {
        return $category->childrenRecursive->isNotEmpty();
    }

    /**
     * Count all descendants.
     */
    public static function descendantCount(Category $category): int
    {
        return self::descendants($category)->count();
    }

    /**
     * Return the category and all descendants as a tree.
     */
    public static function tree(Category $category): Category
    {
        return $category->loadMissing(
            'childrenRecursive.image',
            'childrenRecursive.publishedProducts'
        );
    }
}