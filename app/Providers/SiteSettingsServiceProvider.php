<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Throwable;

class SiteSettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return;
            }

            $settings = Cache::rememberForever('site_settings', function () {
                return SiteSetting::query()
                    ->get()
                    ->mapWithKeys(fn (SiteSetting $setting) => [
                        $setting->key => $setting->typed_value,
                    ])
                    ->all();
            });

            config([
                'site' => $settings,
            ]);
        } catch (Throwable) {
            //
        }
    }
}