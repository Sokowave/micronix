<?php

namespace App\Services\ProductListing\Support;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Collection;

class Brands
{
    public function get(?Category $category = null): Collection
    {
        return Brand::query()
            ->where('status', 'active')
            ->whereHas('products', function ($query) use ($category) {

                $query->published();

                if ($category) {
                    $query->whereIn(
                        'category_id',
                        $category->descendantIds()
                    );
                }
            })
            ->withCount([
                'products' => function ($query) use ($category) {

                    $query->published();

                    if ($category) {
                        $query->whereIn(
                            'category_id',
                            $category->descendantIds()
                        );
                    }
                }
            ])
            ->orderBy('name')
            ->get();
    }
}