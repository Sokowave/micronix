<?php

namespace App\Services\Frontend\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class Index
{
    public function query(array $categoryIds = []): Builder
    {
        $query = Product::query()
            ->with([
                'brand',
                'category',
                'primaryMedia',
            ])
            ->where('is_active', true);

        if ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }

        return $query;
    }
}