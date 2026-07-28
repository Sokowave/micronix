<?php

namespace Database\Seeders;

use App\Models\SeoLandingPage;
use Illuminate\Database\Seeder;

class SeoLandingPageSeeder extends Seeder
{
    public function run(): void
    {
        SeoLandingPage::updateOrCreate(
            [
                'slug' => 'business-computers-under-30000',
            ],
            [
                'name' => 'Business Computers Under KES 30,000',

                'h1' => 'Business Computers Below KES 30,000 in Kenya',

                'intro' => 'Shop affordable business computers below KES 30,000 at Micronix. Explore reliable options for offices, small businesses, schools and everyday productivity.',

                'filters' => [
                    'price' => [
                        'lt' => 30000,
                    ],
                ],

                'meta_title' => 'Business Computers Under KES 30,000 | Micronix',

                'meta_description' => 'Shop business computers below KES 30,000 at Micronix. Find affordable computers for offices, small businesses and everyday work in Kenya.',

                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        SeoLandingPage::updateOrCreate(
            [
                'slug' => 'business-computers-30000-to-50000',
            ],
            [
                'name' => 'Business Computers KES 30,000 - 50,000',

                'h1' => 'Business Computers Between KES 30,000 and KES 50,000 in Kenya',

                'intro' => 'Shop business computers between KES 30,000 and KES 50,000 at Micronix. Compare reliable computers for offices, businesses and professional everyday use.',

                'filters' => [
                    'price' => [
                        'gte' => 30000,
                        'lte' => 50000,
                    ],
                ],

                'meta_title' => 'Business Computers KES 30,000 - 50,000 | Micronix',

                'meta_description' => 'Shop business computers from KES 30,000 to KES 50,000 at Micronix. Compare reliable computers for business, office and professional use in Kenya.',

                'is_active' => true,
                'sort_order' => 2,
            ],
        );
        SeoLandingPage::updateOrCreate(
    [
        'slug' => 'business-computers-under-10000',
    ],
    [
        'name' => 'Business Computers Under KES 10,000',

        'h1' => 'Business Computers Below KES 10,000 in Kenya',

        'intro' => 'Shop affordable business computers below KES 10,000 at Micronix. Explore budget-friendly options for basic office work, schools and everyday computing.',

        'filters' => [
            'price' => [
                'lt' => 10000,
            ],
        ],

        'meta_title' => 'Business Computers Under KES 10,000 | Micronix',

        'meta_description' => 'Shop business computers below KES 10,000 at Micronix. Find budget-friendly computers for basic office work, schools and everyday use in Kenya.',

        'is_active' => true,
        'sort_order' => 3,
    ],
);

SeoLandingPage::updateOrCreate(
    [
        'slug' => 'business-computers-under-200000',
    ],
    [
        'name' => 'Business Computers Under KES 200,000',

        'h1' => 'Business Computers Below KES 200,000 in Kenya',

        'intro' => 'Shop business computers below KES 200,000 at Micronix. Explore reliable and high-performance computers for offices, businesses and professional productivity.',

        'filters' => [
            'price' => [
                'lt' => 200000,
            ],
        ],

        'meta_title' => 'Business Computers Under KES 200,000 | Micronix',

        'meta_description' => 'Shop business computers below KES 200,000 at Micronix. Find reliable computers for offices, businesses and professional use in Kenya.',

        'is_active' => true,
        'sort_order' => 4,
    ],
);


    }
}

// php artisan db:seed --class=SeoLandingPageSeeder