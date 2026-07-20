<?php

namespace App\Services\Sitemaps;

use App\Models\Category;
use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class CategoriesService
{
    public function generate(): Sitemap
    {
        $sitemap = Sitemap::create();

        Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->each(function (Category $category) use ($sitemap) {
                $this->addCategory($category, $sitemap);
            });

        return $sitemap;
    }

    protected function addCategory(Category $category, Sitemap $sitemap): void
    {
        // Skip categories that have no published products
        // in themselves or any descendant.
        if (! $this->hasPublishedProducts($category)) {
            return;
        }

        $sitemap->add(
            Url::create(route('category.show', $category))
                ->setLastModificationDate($category->updated_at)
                ->setPriority(
                    $category->isRoot() ? 0.9 : 0.8
                )
        );

        $category->loadMissing('children');

        foreach ($category->children as $child) {
            $this->addCategory($child, $sitemap);
        }
    }

    protected function hasPublishedProducts(Category $category): bool
    {
        return Product::published()
            ->whereIn('category_id', $category->descendantIds())
            ->exists();
    }
}