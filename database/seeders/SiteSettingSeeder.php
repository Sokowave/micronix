<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            /*
            |--------------------------------------------------------------------------
            | General
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'site_name',
                'value' => 'Micronix',
                'type' => 'string',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Computers, Electronics & Accessories',
                'type' => 'string',
            ],
            [
                'key' => 'site_description',
                'value' => 'Shop computers, laptops, monitors, cameras, networking equipment and accessories from leading brands at Micronix.',
                'type' => 'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'site_email',
                'value' => 'info@micronix.co.ke',
                'type' => 'string',
            ],
            [
                'key' => 'site_phone',
                'value' => '',
                'type' => 'string',
            ],
            [
                'key' => 'site_whatsapp',
                'value' => '',
                'type' => 'string',
            ],
            [
                'key' => 'site_address',
                'value' => 'Nairobi, Kenya',
                'type' => 'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Store
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'currency',
                'value' => 'KES',
                'type' => 'string',
            ],
            [
                'key' => 'currency_symbol',
                'value' => 'KSh',
                'type' => 'string',
            ],
            [
                'key' => 'products_per_page',
                'value' => '24',
                'type' => 'integer',
            ],
            [
                'key' => 'show_out_of_stock',
                'value' => 'true',
                'type' => 'boolean',
            ],
            [
                'key' => 'allow_checkout',
                'value' => 'true',
                'type' => 'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Homepage
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'featured_category_ids',
                'value' => json_encode([]),
                'type' => 'json',
            ],
            [
                'key' => 'featured_brand_ids',
                'value' => json_encode([]),
                'type' => 'json',
            ],
            [
                'key' => 'featured_products_limit',
                'value' => '12',
                'type' => 'integer',
            ],
            [
                'key' => 'new_arrivals_limit',
                'value' => '12',
                'type' => 'integer',
            ],

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'seo_title',
                'value' => 'Micronix | Computers, Electronics & Accessories',
                'type' => 'string',
            ],
            [
                'key' => 'seo_description',
                'value' => 'Shop laptops, computers, monitors, cameras, networking equipment and accessories from leading brands at Micronix Kenya.',
                'type' => 'string',
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'computers, laptops, electronics, accessories, monitors, cameras, networking, Kenya',
                'type' => 'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Social Media
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'social_media',
                'value' => json_encode([
                    [
                        'platform' => 'facebook',
                        'url' => '',
                    ],
                    [
                        'platform' => 'instagram',
                        'url' => '',
                    ],
                    [
                        'platform' => 'x',
                        'url' => '',
                    ],
                    [
                        'platform' => 'tiktok',
                        'url' => '',
                    ],
                    [
                        'platform' => 'youtube',
                        'url' => '',
                    ],
                ]),
                'type' => 'json',
            ],
            /*
            |--------------------------------------------------------------------------
            | Business
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'business_hours',
                'value' => 'Monday - Saturday, 8:00 AM - 6:00 PM',
                'type' => 'string',
            ],
            [
                'key' => 'support_email',
                'value' => 'support@micronix.co.ke',
                'type' => 'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Footer
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'footer_text',
                'value' => 'Your trusted destination for computers, electronics and accessories.',
                'type' => 'string',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                [
                    'key' => $setting['key'],
                ],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                ]
            );
        }
    }
}