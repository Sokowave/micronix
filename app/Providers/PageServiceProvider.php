<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            'frontend.partials.footer.support',
            function ($view) {
                $view->with(
                    'supportPages',
                    Page::published()
                        ->orderBy('title')
                        ->get()
                );
            }
        );

        View::composer(
            'frontend.partials.footer.bottom',
            function ($view) {
                $view->with([
                    'privacyPolicy' => Page::published()
                        ->where('slug', 'privacy-policy')
                        ->first(),

                    'termsConditions' => Page::published()
                        ->where('slug', 'terms-and-conditions')
                        ->first(),
                ]);
            }
        );
    }
}