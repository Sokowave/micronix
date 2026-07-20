<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryMenu extends Component
{
    public $categories;

    public function __construct()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->withCount('publishedProducts')
            ->with('childrenRecursiveWithCount')
            ->orderBy('name')
            ->get();

        $this->categories = $categories
            ->map(fn (Category $category) => $this->filterTree($category))
            ->filter()
            ->values()
            ->take(10);
    }

    protected function filterTree(Category $category): ?Category
    {
        $filteredChildren = $category->childrenRecursiveWithCount
            ->map(fn (Category $child) => $this->filterTree($child))
            ->filter()
            ->values();

        // Inherit published product counts from descendants
        $totalPublishedProducts = (int) $category->published_products_count;

        foreach ($filteredChildren as $child) {
            $totalPublishedProducts += (int) $child->published_products_count;
        }

        $category->published_products_count = $totalPublishedProducts;

        // Expose the filtered tree through the original relationship
        // so the Blade can continue using childrenRecursive.
        $category->setRelation(
            'childrenRecursive',
            $filteredChildren
        );

        // Remove the temporary relationship.
        $category->unsetRelation('childrenRecursiveWithCount');

        // Remove empty branches.
        if ($totalPublishedProducts === 0) {
            return null;
        }

        return $category;
    }

    public function render()
    {
        return view('components.category-menu');
    }
}