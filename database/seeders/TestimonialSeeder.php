<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::insert([
            [
                'first_name' => 'Albert',
                'last_name' => 'Osiemo',
                'position' => 'Founder, Pomalo Technologies Ltd',
                'testimonial' => 'Kasio Digital Connections helped us source laptops for our office quickly. Excellent pricing, genuine products and professional support.',
                'rating' => 5,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'first_name' => 'Mary',
                'last_name' => 'Wanjiku',
                'position' => 'School Administrator',
                'testimonial' => 'We purchased networking equipment and printers for our school. Delivery was fast and the support team was very responsive.',
                'rating' => 5,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'first_name' => 'Brian',
                'last_name' => 'Ochieng',
                'position' => 'IT Manager',
                'testimonial' => 'Our go-to supplier for ICT hardware. Great customer service, genuine products and reliable after-sales support.',
                'rating' => 5,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}