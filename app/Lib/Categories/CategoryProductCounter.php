<?php

namespace App\Lib\Categories;

use App\Models\Category;

class CategoryProductCounter
{
    /**
     * Determine whether the category or any of its descendants
     * contains published products.
     */
    public static function hasPublishedProducts(Category $category): bool
    {
        if ($category->publishedProducts->isNotEmpty()) {
            return true;
        }

        foreach ($category->childrenRecursive as $child) {
            if (self::hasPublishedProducts($child)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Count published products in this category and all descendants.
     */
    public static function count(Category $category): int
    {
        $count = $category->publishedProducts->count();

        foreach ($category->childrenRecursive as $child) {
            $count += self::count($child);
        }

        return $count;
    }
}