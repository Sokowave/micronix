<?php

namespace App\Providers;

use App\Data\NavigationCategoryData;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Inertia::share('navigation', fn () => [
            'categories' => NavigationCategoryData::collect(
                Category::query()
                    ->whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->with('childrenRecursive')
                    ->get()
            ),
        ]);
    }
}