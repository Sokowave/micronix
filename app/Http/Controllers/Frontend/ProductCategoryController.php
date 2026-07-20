<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private array $sortOptions = [
        'newest'     => 'Latest Arrivals',
        'price_asc'  => 'Price: Low to High',
        'price_desc' => 'Price: High to Low',
        'name'       => 'Name (A-Z)',
    ];

    public function show(Request $request, string $slug)
    {
        $category = Category::with('children.children')
            ->where('slug', $slug)
            ->firstOrFail();

        $categoryIds = $this->getAllCategoryIds($category);

        $sort = $request->input('sort', 'newest');

        if (! array_key_exists($sort, $this->sortOptions)) {
            $sort = 'newest';
        }

        $productsQuery = Product::query()
            ->published()
            ->with([
                'images',
                'brand',
                'category.parent',
            ])
            ->whereIn('category_id', $categoryIds);

        $allProducts = (clone $productsQuery)->get();

        $minPriceDefault = $allProducts->min('current_price') ?? 0;
        $maxPriceDefault = $allProducts->max('current_price') ?? 0;

        if ($request->filled('min_price')) {
            $min = (float) $request->min_price;

            $productsQuery->where(function ($query) use ($min) {
                $query->where('price', '>=', $min)
                    ->orWhere('sale_price', '>=', $min);
            });
        }

        if ($request->filled('max_price')) {
            $max = (float) $request->max_price;

            $productsQuery->where(function ($query) use ($max) {
                $query->where('price', '<=', $max)
                    ->orWhere('sale_price', '<=', $max);
            });
        }

        $this->applySorting($productsQuery, $sort);

        $products = $productsQuery
            ->paginate(24)
            ->appends($request->query());

        $childCategories = $category->children
            ->filter(fn (Category $child) => $this->hasPublishedProductsInTree($child))
            ->values();

        return view('frontend.product_listing', [
            'category'          => $category,
            'products'          => $products,
            'breadcrumbs'       => $category->getBreadcrumbs(),
            'childCategories'   => $childCategories,
            'selectedView'      => $request->cookie('productView', 'grid'),
            'sort'              => $sort,
            'sortLabel'         => $this->sortOptions[$sort],
            'sortOptions'       => $this->sortOptions,
            'min_price'         => $request->min_price,
            'max_price'         => $request->max_price,
            'min_price_default' => $minPriceDefault,
            'max_price_default' => $maxPriceDefault,
        ]);
    }

    private function getAllCategoryIds(Category $category): array
    {
        $ids = collect([$category->id]);

        foreach ($category->children as $child) {
            $ids = $ids->merge(
                $this->getAllCategoryIds($child)
            );
        }

        return $ids->unique()->values()->all();
    }

    private function hasPublishedProductsInTree(Category $category): bool
    {
        if ($category->publishedProducts()->exists()) {
            return true;
        }

        foreach ($category->children as $child) {
            if ($this->hasPublishedProductsInTree($child)) {
                return true;
            }
        }

        return false;
    }

    private function applySorting($query, string $sort): void
    {
        match ($sort) {
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),

            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),

            'name' => $query->orderBy('title'),

            default => $query->latest(),
        };
    }
}