<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Computers',
                'icon' => 'computer-desktop',
                'children' => [
                    [
                        'name' => 'Laptops',
                        'icon' => 'computer-desktop',
                        'children' => [
                            ['name' => 'Business Laptops', 'icon' => 'briefcase'],
                            ['name' => 'Gaming Laptops', 'icon' => 'bolt'],
                            ['name' => '2-in-1 Laptops', 'icon' => 'device-tablet'],
                            ['name' => 'MacBooks', 'icon' => 'computer-desktop'],
                        ],
                    ],
                    [
                        'name' => 'Desktop Computers',
                        'icon' => 'computer-desktop',
                        'children' => [
                            ['name' => 'Business Desktops', 'icon' => 'briefcase'],
                            ['name' => 'Gaming Desktops', 'icon' => 'bolt'],
                            ['name' => 'All-in-One Computers', 'icon' => 'computer-desktop'],
                            ['name' => 'Mini PCs', 'icon' => 'cpu-chip'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Computer Components',
                'icon' => 'cpu-chip',
                'children' => [
                    [
                        'name' => 'Internal Components',
                        'icon' => 'cpu-chip',
                        'children' => [
                            ['name' => 'Processors', 'icon' => 'cpu-chip'],
                            ['name' => 'Motherboards', 'icon' => 'rectangle-stack'],
                            ['name' => 'Memory', 'icon' => 'circle-stack'],
                            ['name' => 'Graphics Cards', 'icon' => 'rectangle-stack'],
                        ],
                    ],
                    [
                        'name' => 'Storage',
                        'icon' => 'circle-stack',
                        'children' => [
                            ['name' => 'Solid State Drives', 'icon' => 'circle-stack'],
                            ['name' => 'Hard Drives', 'icon' => 'circle-stack'],
                            ['name' => 'External Drives', 'icon' => 'circle-stack'],
                            ['name' => 'USB Flash Drives', 'icon' => 'circle-stack'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Monitors',
                'icon' => 'computer-desktop',
                'children' => [
                    [
                        'name' => 'Computer Monitors',
                        'icon' => 'computer-desktop',
                        'children' => [
                            ['name' => 'Business Monitors', 'icon' => 'briefcase'],
                            ['name' => 'Gaming Monitors', 'icon' => 'bolt'],
                            ['name' => 'Ultrawide Monitors', 'icon' => 'arrows-pointing-out'],
                            ['name' => 'Portable Monitors', 'icon' => 'computer-desktop'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Printers & Scanners',
                'icon' => 'printer',
                'children' => [
                    [
                        'name' => 'Printers',
                        'icon' => 'printer',
                        'children' => [
                            ['name' => 'Inkjet Printers', 'icon' => 'printer'],
                            ['name' => 'Laser Printers', 'icon' => 'printer'],
                            ['name' => 'All-in-One Printers', 'icon' => 'printer'],
                            ['name' => 'Thermal Printers', 'icon' => 'printer'],
                        ],
                    ],
                    [
                        'name' => 'Scanners',
                        'icon' => 'document-magnifying-glass',
                        'children' => [
                            ['name' => 'Document Scanners', 'icon' => 'document'],
                            ['name' => 'Flatbed Scanners', 'icon' => 'document'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Networking',
                'icon' => 'wifi',
                'children' => [
                    [
                        'name' => 'Network Devices',
                        'icon' => 'wifi',
                        'children' => [
                            ['name' => 'Routers', 'icon' => 'wifi'],
                            ['name' => 'Mesh Wi-Fi', 'icon' => 'signal'],
                            ['name' => 'Network Switches', 'icon' => 'arrows-right-left'],
                            ['name' => 'Access Points', 'icon' => 'signal'],
                        ],
                    ],
                    [
                        'name' => 'Network Accessories',
                        'icon' => 'globe-alt',
                        'children' => [
                            ['name' => 'Network Adapters', 'icon' => 'signal'],
                            ['name' => 'Ethernet Cables', 'icon' => 'link'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Computer Accessories',
                'icon' => 'squares-2x2',
                'children' => [
                    [
                        'name' => 'Input Devices',
                        'icon' => 'cursor-arrow-rays',
                        'children' => [
                            ['name' => 'Keyboards', 'icon' => 'computer-desktop'],
                            ['name' => 'Mice', 'icon' => 'cursor-arrow-rays'],
                            ['name' => 'Keyboard & Mouse Combos', 'icon' => 'computer-desktop'],
                        ],
                    ],
                    [
                        'name' => 'Laptop Accessories',
                        'icon' => 'computer-desktop',
                        'children' => [
                            ['name' => 'Laptop Bags', 'icon' => 'briefcase'],
                            ['name' => 'Laptop Stands', 'icon' => 'computer-desktop'],
                            ['name' => 'Laptop Chargers', 'icon' => 'bolt'],
                            ['name' => 'Docking Stations', 'icon' => 'rectangle-group'],
                        ],
                    ],
                    [
                        'name' => 'Audio & Video',
                        'icon' => 'speaker-wave',
                        'children' => [
                            ['name' => 'Headsets', 'icon' => 'speaker-wave'],
                            ['name' => 'Speakers', 'icon' => 'speaker-wave'],
                            ['name' => 'Webcams', 'icon' => 'video-camera'],
                            ['name' => 'Microphones', 'icon' => 'microphone'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Cameras',
                'icon' => 'camera',
                'children' => [
                    [
                        'name' => 'Digital Cameras',
                        'icon' => 'camera',
                        'children' => [
                            ['name' => 'Mirrorless Cameras', 'icon' => 'camera'],
                            ['name' => 'DSLR Cameras', 'icon' => 'camera'],
                            ['name' => 'Action Cameras', 'icon' => 'video-camera'],
                        ],
                    ],
                    [
                        'name' => 'Camera Accessories',
                        'icon' => 'camera',
                        'children' => [
                            ['name' => 'Camera Lenses', 'icon' => 'camera'],
                            ['name' => 'Tripods', 'icon' => 'camera'],
                            ['name' => 'Memory Cards', 'icon' => 'circle-stack'],
                            ['name' => 'Camera Bags', 'icon' => 'briefcase'],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Power & Backup',
                'icon' => 'bolt',
                'children' => [
                    [
                        'name' => 'Power Solutions',
                        'icon' => 'bolt',
                        'children' => [
                            ['name' => 'UPS', 'icon' => 'battery-100'],
                            ['name' => 'Surge Protectors', 'icon' => 'shield-check'],
                            ['name' => 'Power Adapters', 'icon' => 'bolt'],
                            ['name' => 'Extension Cables', 'icon' => 'bolt'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($categories as $parentPosition => $parentData) {
            $parent = $this->createCategory(
                data: $parentData,
                parentId: null,
                position: $parentPosition + 1,
            );

            foreach ($parentData['children'] ?? [] as $childPosition => $childData) {
                $child = $this->createCategory(
                    data: $childData,
                    parentId: $parent->id,
                    position: $childPosition + 1,
                );

                foreach ($childData['children'] ?? [] as $grandchildPosition => $grandchildData) {
                    $this->createCategory(
                        data: $grandchildData,
                        parentId: $child->id,
                        position: $grandchildPosition + 1,
                    );
                }
            }
        }
    }

    private function createCategory(
        array $data,
        ?int $parentId,
        int $position,
    ): Category {
        return Category::updateOrCreate(
            [
                'slug' => Str::slug($data['name']),
            ],
            [
                'parent_id' => $parentId,
                'media_id' => null,
                'name' => $data['name'],
                'icon' => $data['icon'] ?? null,
                'description' => null,
                'meta_title' => null,
                'meta_description' => null,
                'is_active' => true,
                'position' => $position,
            ]
        );
    }
}