<?php

namespace App\Services\Frontend\Product;

use App\Services\Frontend\Category;
use Illuminate\Support\Collection;

class CategorySections
{
    public function __construct(
        private Category $categories,
        private Index $products,
    ) {}

    /**
     * Get parent category sections with random products
     * from all descendant categories.
     */
    public function get(): Collection
    {
        return $this->categories
            ->parents()
            ->map(function ($category) {
                $categoryIds = $this->categories
                    ->idsWithDescendants($category);

                $products = $this->products
                    ->query($categoryIds)
                    ->inRandomOrder()
                    ->limit(12)
                    ->get();

                return [
                    'category' => $category,
                    'products' => $products,
                ];
            })
            ->filter(
                fn (array $section) => $section['products']->isNotEmpty()
            )
            ->values();
    }
}