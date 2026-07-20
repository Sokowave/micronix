<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryTreeService
{
    /**
     * Get the active category tree with published product counts.
     */
    public function tree(): Collection
    {
        return Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->withCount('publishedProducts')
            ->with('childrenRecursiveWithCount')
            ->orderBy('name')
            ->get()
            ->map(fn (Category $category) => $this->filterTree($category))
            ->filter()
            ->values();
    }

    /**
     * Filter the category tree to only include branches
     * containing published products.
     */
    protected function filterTree(Category $category): ?Category
    {
        $filteredChildren = $category->childrenRecursiveWithCount
            ->map(fn (Category $child) => $this->filterTree($child))
            ->filter()
            ->values();

        $totalPublishedProducts = (int) $category->published_products_count;

        foreach ($filteredChildren as $child) {
            $totalPublishedProducts += (int) $child->published_products_count;
        }

        $category->published_products_count = $totalPublishedProducts;

        $category->setRelation(
            'childrenRecursive',
            $filteredChildren
        );

        $category->unsetRelation(
            'childrenRecursiveWithCount'
        );

        return $totalPublishedProducts > 0
            ? $category
            : null;
    }
}