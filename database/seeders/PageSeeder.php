<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '',
                'seo_title' => 'Privacy Policy',
                'seo_description' => 'Read our Privacy Policy.',
                'is_published' => false,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '',
                'seo_title' => 'Terms & Conditions',
                'seo_description' => 'Read our Terms & Conditions.',
                'is_published' => false,
            ],
            [
                'title' => 'Shipping Policy',
                'slug' => 'shipping-policy',
                'content' => '',
                'seo_title' => 'Shipping Policy',
                'seo_description' => 'Learn about our shipping policy.',
                'is_published' => false,
            ],
            [
                'title' => 'Returns & Refunds',
                'slug' => 'returns-refunds',
                'content' => '',
                'seo_title' => 'Returns & Refunds',
                'seo_description' => 'Read our returns and refunds policy.',
                'is_published' => false,
            ],
            [
                'title' => 'Warranty Information',
                'slug' => 'warranty-information',
                'content' => '',
                'seo_title' => 'Warranty Information',
                'seo_description' => 'Learn about our warranty information.',
                'is_published' => false,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}