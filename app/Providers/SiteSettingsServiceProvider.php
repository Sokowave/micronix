<?php

namespace App\Providers;

use App\Data\SiteSettingsData;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = SiteSettingsData::fromSettings();

        View::share([
            'settings' => $settings,
        ]);

        Inertia::share([
            'settings' => fn () => $settings,
        ]);
    }
}