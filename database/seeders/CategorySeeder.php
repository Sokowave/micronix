<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
$data = [

    'Phone Accessories' => [

        'Cases & Covers' => [
            'Silicone Cases',
            'Leather Cases',
            'Rugged Cases',
            'Clear Cases',
            'Wallet Cases',
        ],

        'Screen Protection' => [
            'Tempered Glass',
            'Privacy Screen Protectors',
            'Camera Lens Protectors',
        ],

        'Mounts & Holders' => [
            'Car Mounts',
            'Desktop Phone Holders',
            'Ring Holders',
            'Selfie Sticks',
            'Tripods',
        ],

        'SIM & Accessories' => [
            'SIM Card Adapters',
            'SIM Ejector Pins',
            'Phone Lanyards',
        ],

    ],

    'Charging & Power' => [

        'Chargers' => [
            'Wall Chargers',
            'Fast Chargers',
            'Wireless Chargers',
            'Car Chargers',
        ],

        'Charging Cables' => [
            'USB-C Cables',
            'Lightning Cables',
            'Micro USB Cables',
            'Multi Charging Cables',
        ],

        'Power Banks' => [
            'Mini Power Banks',
            'Fast Charging Power Banks',
            'Wireless Power Banks',
        ],

        'Power Accessories' => [
            'Charging Stations',
            'Travel Adapters',
            'Extension Cables',
            'Power Strips',
        ],

    ],

    'Audio' => [

        'Earphones' => [
            'Wired Earphones',
            'USB-C Earphones',
            'Lightning Earphones',
        ],

        'Wireless Audio' => [
            'True Wireless Earbuds',
            'Bluetooth Neckbands',
            'Bluetooth Headsets',
        ],

        'Headphones' => [
            'Over-Ear Headphones',
            'On-Ear Headphones',
            'Gaming Headsets',
        ],

        'Speakers' => [
            'Bluetooth Speakers',
            'Portable Speakers',
            'Smart Speakers',
        ],

    ],

    'Smart Watches & Wearables' => [

        'Smart Watches' => [
            'Android Smart Watches',
            'Fitness Smart Watches',
            'Kids Smart Watches',
        ],

        'Fitness Bands' => [
            'Fitness Trackers',
            'Heart Rate Bands',
        ],

        'Watch Accessories' => [
            'Watch Straps',
            'Watch Chargers',
            'Screen Protectors',
        ],

    ],

    'Computer Accessories' => [

        'Keyboards' => [
            'Wireless Keyboards',
            'Mechanical Keyboards',
        ],

        'Mice' => [
            'Wireless Mice',
            'Gaming Mice',
        ],

        'Laptop Accessories' => [
            'Laptop Stands',
            'Cooling Pads',
            'USB Hubs',
        ],

        'Storage' => [
            'USB Flash Drives',
            'External SSDs',
            'External HDDs',
        ],

    ],

    'Gaming Accessories' => [

        'Controllers' => [
            'Wireless Controllers',
            'Mobile Game Controllers',
        ],

        'Gaming Headsets' => [
            'PC Gaming Headsets',
            'Console Gaming Headsets',
        ],

        'Gaming Accessories' => [
            'Cooling Fans',
            'Finger Sleeves',
            'Controller Grips',
        ],

    ],

    'Cameras & Photography' => [

        'Camera Accessories' => [
            'Memory Cards',
            'Camera Batteries',
            'Camera Bags',
        ],

        'Tripods' => [
            'Phone Tripods',
            'Camera Tripods',
        ],

        'Lighting' => [
            'Ring Lights',
            'LED Video Lights',
        ],

    ],

    'Car Accessories' => [

        'Phone Mounts' => [
            'Dashboard Mounts',
            'Air Vent Mounts',
        ],

        'Car Chargers' => [
            'USB Car Chargers',
            'Fast Car Chargers',
        ],

        'Car Electronics' => [
            'Bluetooth FM Transmitters',
            'Dash Cameras',
        ],

    ],

    'Cables & Adapters' => [

        'USB Cables' => [
            'USB-C',
            'Lightning',
            'Micro USB',
        ],

        'Video Cables' => [
            'HDMI',
            'DisplayPort',
            'VGA',
        ],

        'Adapters' => [
            'USB-C Adapters',
            'OTG Adapters',
            'Audio Adapters',
        ],

    ],

    'Networking' => [

        'Wi-Fi Devices' => [
            'Wi-Fi Routers',
            'Wi-Fi Extenders',
        ],

        'Networking Accessories' => [
            'Ethernet Cables',
            'Network Switches',
        ],

    ],

    'Storage & Memory' => [

        'Memory Cards' => [
            'microSD Cards',
            'SD Cards',
        ],

        'Flash Storage' => [
            'USB Flash Drives',
            'OTG Flash Drives',
        ],

        'External Storage' => [
            'External SSDs',
            'External Hard Drives',
        ],

    ],

    'Smart Home & Lifestyle' => [

        'Smart Devices' => [
            'Smart Bulbs',
            'Smart Plugs',
            'Smart Cameras',
        ],

        'Lifestyle Gadgets' => [
            'Mini Fans',
            'Desk Lamps',
            'Digital Clocks',
        ],

        'Travel Accessories' => [
            'Travel Organizers',
            'Cable Organizers',
            'Tech Pouches',
        ],

    ],
    'Health & Personal Care' => [

    'Personal Care Devices' => [
        'Electric Toothbrushes',
        'Hair Trimmers',
        'Hair Dryers',
        'Electric Shavers',
    ],

    'Health Devices' => [
        'Digital Thermometers',
        'Pulse Oximeters',
        'Blood Pressure Monitors',
    ],

    'Massagers' => [
        'Massage Guns',
        'Neck Massagers',
        'Foot Massagers',
    ],

],

'Office & Desk Setup' => [

    'Desk Accessories' => [
        'Laptop Stands',
        'Monitor Stands',
        'Desk Mats',
        'Cable Organizers',
    ],

    'Office Electronics' => [
        'Webcams',
        'Microphones',
        'Presentation Remotes',
    ],

    'Lighting' => [
        'Desk Lamps',
        'Monitor Light Bars',
        'LED Desk Lights',
    ],

],

];

                foreach ($data as $level1 => $level2Items) {

            $slug = Str::slug($level1);

            $media = Media::create([
                'public_id' => (string) Str::ulid(),
                'disk' => 'public',
                'folder' => 'categories',
                'path' => "categories/{$slug}.jpg",
            ]);

            $parent = Category::create([
                'parent_id' => null,
                'media_id' => $media->id,
                'public_id' => (string) Str::ulid(),
                'name' => $level1,
                'slug' => $slug,
                'meta_title' => $level1,
                'meta_description' => $level1,
                'is_featured' => true,
                'is_active' => true,
            ]);

            foreach ($level2Items as $level2 => $level3Items) {

                $childSlug = Str::slug($level2);

                $child = Category::create([
                    'parent_id' => $parent->id,
                    'media_id' => null,
                    'public_id' => (string) Str::ulid(),
                    'name' => $level2,
                    'slug' => $childSlug,
                    'meta_title' => $level2,
                    'meta_description' => $level2,
                    'is_featured' => false,
                    'is_active' => true,
                ]);

                foreach ($level3Items as $level3) {

                    $grandchildSlug = Str::slug($level3);

                    Category::create([
                        'parent_id' => $child->id,
                        'media_id' => null,
                        'public_id' => (string) Str::ulid(),
                        'name' => $level3,
                        'slug' => $grandchildSlug,
                        'meta_title' => $level3,
                        'meta_description' => $level3,
                        'is_featured' => false,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}