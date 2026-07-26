<?php

namespace App\Services\Frontend;

use App\Models\Category;
use Illuminate\Support\Collection;

class Breadcrumb
{
    public function category(?Category $category): Collection
    {
        if (! $category) {
            return collect();
        }

        $breadcrumbs = collect();

        while ($category) {
            $breadcrumbs->prepend($category);

            $category = $category->parent;
        }

        return $breadcrumbs;
    }
}