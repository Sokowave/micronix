<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Gaming Setup',
                'description' => 'Everything you need for the ultimate gaming experience.',
                'meta_title' => 'Gaming Setup & Accessories in Kenya | Micronix',
                'meta_description' => 'Shop gaming laptops, monitors, keyboards, mice, headsets and accessories for your gaming setup.',
                'position' => 1,
            ],
            [
                'name' => 'Office Setup',
                'description' => 'Reliable tech for productive workspaces.',
                'meta_title' => 'Office Setup & Equipment in Kenya | Micronix',
                'meta_description' => 'Shop laptops, monitors, printers, networking equipment and accessories for your office setup.',
                'position' => 2,
            ],
            [
                'name' => 'Student Essentials',
                'description' => 'Affordable tech essentials for study and everyday use.',
                'meta_title' => 'Student Tech Essentials in Kenya | Micronix',
                'meta_description' => 'Shop laptops, storage, accessories and other essential technology for students in Kenya.',
                'position' => 3,
            ],
            [
                'name' => 'Content Creation',
                'description' => 'Powerful tools for creators, streamers and professionals.',
                'meta_title' => 'Content Creation Equipment in Kenya | Micronix',
                'meta_description' => 'Shop cameras, microphones, computers, storage and accessories for content creation.',
                'position' => 4,
            ],
            [
                'name' => 'Home Entertainment',
                'description' => 'Upgrade your home entertainment and multimedia experience.',
                'meta_title' => 'Home Entertainment Electronics in Kenya | Micronix',
                'meta_description' => 'Shop displays, audio equipment, accessories and electronics for your home entertainment setup.',
                'position' => 5,
            ],
            [
                'name' => 'Work From Home',
                'description' => 'Build a comfortable and productive home workspace.',
                'meta_title' => 'Work From Home Setup in Kenya | Micronix',
                'meta_description' => 'Shop laptops, monitors, webcams, networking products and accessories for working from home.',
                'position' => 6,
            ],
        ];

        foreach ($collections as $collection) {
            Collection::query()->updateOrCreate(
                [
                    'slug' => Str::slug($collection['name']),
                ],
                [
                    'name' => $collection['name'],
                    'description' => $collection['description'],
                    'meta_title' => $collection['meta_title'],
                    'meta_description' => $collection['meta_description'],
                    'is_active' => true,
                    'position' => $collection['position'],
                ]
            );
        }
    }
}