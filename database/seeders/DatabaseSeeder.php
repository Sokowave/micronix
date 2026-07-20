<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductTagSeeder::class,
            BannerSeeder::class,
            TestimonialSeeder::class,
            PageSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}

//php artisan db:seed
//  php artisan migrate:fresh --seed


