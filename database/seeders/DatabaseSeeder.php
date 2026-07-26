<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            // Core data
            BrandSeeder::class,
            SpecificationSeeder::class,
            CategorySeeder::class,

            // Relationships
            CategorySpecificationSeeder::class,

            // Content
            BannerSeeder::class,
            ProductSeeder::class,

            SiteSettingSeeder::class,
        ]);
    }
}

//php artisan migrate:fresh --seed