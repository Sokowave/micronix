<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListingBladeCategoryMenu extends Component
{
    public Collection $categories;
    public Collection $subcategories;
    public Collection $categoryChain;

    public ?Category $currentCategory;
    public ?Brand $currentBrand;

    public function __construct(
        ?Category $currentCategory = null,
        ?Brand $currentBrand = null
    ) {
        $this->currentCategory = $currentCategory;
        $this->currentBrand = $currentBrand;

        /*
        |--------------------------------------------------------------------------
        | Category Listing Page
        |--------------------------------------------------------------------------
        */

        if ($currentCategory) {

            $this->categoryChain = $currentCategory->getBreadcrumbs();

            $subcategories = $currentCategory->children()
                ->where('is_active', true)
                ->withCount([
                    'publishedProducts',
                ])
                ->orderBy('name')
                ->get();

            if ($currentBrand) {

                $subcategories = $subcategories->filter(function ($category) use ($currentBrand) {

                    return $category->publishedProducts()
                        ->where('brand_id', $currentBrand->id)
                        ->exists();
                })->values();

            } else {

                $subcategories = $subcategories
                    ->where('published_products_count', '>', 0)
                    ->values();

            }

            $this->subcategories = $subcategories;

            $this->categories = $this->categoryChain;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Root Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->withCount([
                'publishedProducts',
            ])
            ->orderBy('name')
            ->get();

        if ($currentBrand) {

            $categories = $categories->filter(function ($category) use ($currentBrand) {

                return $category->publishedProducts()
                    ->where('brand_id', $currentBrand->id)
                    ->exists();

            })->values();

        } else {

            $categories = $categories
                ->where('published_products_count', '>', 0)
                ->values();

        }

        $this->categories = $categories;

        $this->subcategories = collect();

        $this->categoryChain = collect();
    }

    public function render()
    {
        return view('components.listing-blade-category-menu');
    }
}