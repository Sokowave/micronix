<?php

namespace App\Providers;

use App\Services\CategoryTreeService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(CategoryTreeService $categoryTree): void
    {
        View::composer(
            'frontend.partials.footer.shop',
            function ($view) use ($categoryTree) {

                $view->with(
                    'footerCategories',
                    $categoryTree->tree()
                        ->shuffle()
                        ->take(5)
                        ->values()
                );

            }
        );
    }
}