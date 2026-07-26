<?php

namespace App\Services\Frontend;

use App\Models\Category;
use App\Models\Tag;
use App\Services\Frontend\Product\Index as ProductIndex;
use Illuminate\Database\Eloquent\Builder;

class Search
{
    /**
     * Apply search to a product query.
     */
    public function apply(Builder $query, string $search): Builder
    {
        $search = trim($search);

        if ($search === '') {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query
                ->whereHas(
                    'tags',
                    fn (Builder $query) => $query
                        ->where('name', 'like', "%{$search}%")
                )
                ->orWhereHas(
                    'category',
                    fn (Builder $query) => $query
                        ->where('name', 'like', "%{$search}%")
                )
                ->orWhereHas(
                    'brand',
                    fn (Builder $query) => $query
                        ->where('name', 'like', "%{$search}%")
                )
                ->orWhere('name', 'like', "%{$search}%");
        });
    }

    /**
     * Get autocomplete suggestions.
     */
    public function suggestions(
        ProductIndex $products,
        string $search,
        int $limit = 5,
    ): array {
        $search = trim($search);

        if ($search === '') {
            return [
                'tags' => collect(),
                'categories' => collect(),
                'products' => collect(),
            ];
        }

        return [
            'tags' => Tag::query()
                ->where('name', 'like', "%{$search}%")
                ->orderBy('name')
                ->limit($limit)
                ->get(),

            'categories' => Category::query()
                ->where('is_active', true)
                ->where('name', 'like', "%{$search}%")
                ->orderBy('name')
                ->limit($limit)
                ->get(),

            'products' => $products
                ->query()
                ->where('name', 'like', "%{$search}%")
                ->orderBy('name')
                ->limit($limit)
                ->get(),
        ];
    }
}