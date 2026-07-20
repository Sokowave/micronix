<?php

namespace App\Services\Home;

use App\Data\NavigationCategoryData;
use App\Models\Category;

class HeroCategoryService
{
    /**
     * Get hero categories.
     *
     * @return \Illuminate\Support\Collection<int, NavigationCategoryData>
     */
    public function get(int $limit = 12)
    {
        return NavigationCategoryData::collect(
            Category::query()
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->with('childrenRecursive')
                ->orderBy('name')
                ->limit($limit)
                ->get()
        );
    }
}