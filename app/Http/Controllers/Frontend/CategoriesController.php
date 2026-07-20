<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display the categories page.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->withCount('publishedProducts')
            ->with('childrenRecursiveWithCount')
            ->orderBy('name')
            ->get()
            ->map(fn (Category $category) => $this->filterTree($category))
            ->filter()
            ->values();

        return view('frontend.categories.index', compact('categories'));
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