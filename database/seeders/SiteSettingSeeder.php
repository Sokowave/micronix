<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $logo = Media::firstOrCreate(
            ['path' => 'uploads/site-assets/202607/micronix-logo1.png'],
            [
                'disk' => 'public',
                'folder' => 'site-assets',
                'url' => "{$baseUrl}/uploads/site-assets/202607/micronix-logo1.png",
            ]
        );

        $icon = Media::firstOrCreate(
            ['path' => 'uploads/site-assets/202607/micronix-icon1.png'],
            [
                'disk' => 'public',
                'folder' => 'site-assets',
                'url' => "{$baseUrl}/uploads/site-assets/202607/micronix-icon1.png",
            ]
        );

        $settings = [

            // General
            'site_name' => ['Micronix Gadgets', 'string'],
            'site_url' => [$baseUrl, 'string'],
            'locale' => ['en_KE', 'string'],
            'theme_color' => ['#ffffff', 'string'],

            // Branding
            'site_logo' => [$logo->id, 'media'],
            'site_icon' => [$icon->id, 'media'],
            'apple_touch_icon' => [$icon->id, 'media'],

            // SEO
            'site_seo_title' => [
                'Micronix Gadgets | Phone Accessories, Gadgets & Electronics',
                'string',
            ],

            'site_seo_description' => [
                'Shop genuine phone accessories, chargers, earphones, power banks, smartwatches and electronics with fast delivery across Kenya.',
                'string',
            ],

            'seo_image' => [$logo->id, 'media'],

            // Contact
            'business_phone' => ['+254700000000', 'string'],
            'whatsapp_number' => ['254700000000', 'string'],

            // Currency
            'currency_code' => ['KES', 'string'],
            'site_currency' => ['KSh', 'string'],

            // Homepage
            'homepage_hero_title' => [
                'Everything Tech. Delivered.',
                'string',
            ],

            'homepage_hero_description' => [
                'Discover genuine gadgets and accessories at unbeatable prices.',
                'string',
            ],
        ];

        foreach ($settings as $key => [$value, $type]) {
            SiteSetting::set($key, $value, $type);
        }
    }
}