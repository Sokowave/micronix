<?php

namespace App\Traits\Products;

use App\Models\Product;

trait HandleProductKeywords
{
    /**
     * Generate meta keywords for a product
     *
     * Priority:
     * 1. Product tags (best SEO source)
     * 2. Product custom keywords (DB)
     * 3. Product name fallback
     */
    protected function generateMetaKeywords(Product $product): string
    {
        // 1. Tags (highest priority)
        $tags = $product->tags()->pluck('name');

        if ($tags->isNotEmpty()) {
            return $tags->unique()->implode(', ');
        }

        // 2. DB keywords (if available)
        if (method_exists($product, 'keywords')) {
            $dbKeywords = $product->keywords()
                ->limit(20)
                ->pluck('name');

            if ($dbKeywords->isNotEmpty()) {
                return $dbKeywords->unique()->implode(', ');
            }
        }

        // 3. Fallback: product name words
        return collect(
            preg_split('/\s+/', preg_replace('/[^A-Za-z0-9\s]/', '', $product->title))
        )
        ->filter(fn ($word) => strlen($word) > 2)
        ->unique()
        ->implode(', ');
    }
}