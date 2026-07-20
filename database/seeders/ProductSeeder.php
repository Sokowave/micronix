<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::doesntHave('children')->get();
        $brands = Brand::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Please seed categories first.');

            return;
        }

        $imageUrls = [
            'https://image.kilimall.com/kenya/shop/store/goods/8684/2023/06/16858000606348507a00d8833497b9eec643f95c149db.jpg',
            'https://img.kilimall.com/c/obs/seller/100010726/goods_image/251114120451_2c096bcfeb9f382c8428c68f4e384b5c.jpg',
            'https://img.kilimall.com/c/obs/seller/9751/goods_image/250211143411_0ce369c03d61b78726be7dfd84bbfb2a.jpg',
            'https://image.kilimall.com/kenya/shop/store/goods/5464/2023/07/1688623440947b2d1a9cf2a3b416a8a7835245cc14a97.jpg',
            'https://image.kilimall.com/kenya/shop/store/goods/1213/2022/04/1650769529262efd1d73631c448e2b6f541acfea2bf5b.jpg',
            'https://image.kilimall.com/kenya/shop/store/goods/1213/2022/09/1664184117356fc4b26f643804a77acc12af981f5757e.jpg',
        ];

        $products = [
            'Anker 65W USB-C Charger',
            'UGREEN USB-C Cable',
            'Logitech MX Master 3S Mouse',
            'Dell 24-inch Monitor',
            'HP USB Keyboard',
            'Kingston 64GB Flash Drive',
            'Samsung T7 Portable SSD',
            'TP-Link Archer AX23 Router',
            'JBL Flip Bluetooth Speaker',
            'Sony WH-CH520 Headphones',
        ];

        foreach ($products as $title) {

            $price = fake()->numberBetween(1500, 35000);

            $salePrice = fake()->boolean(60)
                ? fake()->numberBetween((int) ($price * 0.7), $price - 100)
                : null;

            $product = Product::create([
                'category_id' => $categories->random()->id,

                'brand_id' => $brands->isNotEmpty()
                    ? $brands->random()->id
                    : null,

                'title' => $title,

                'short_description' => fake()->sentence(),

                'description' => fake()->paragraphs(4, true),

                'specifications' => [
                    [
                        'name' => 'Connectivity',
                        'value' => fake()->randomElement([
                            'USB-C',
                            'USB-A',
                            'Bluetooth 5.3',
                            'Wi-Fi 6',
                        ]),
                    ],
                    [
                        'name' => 'Material',
                        'value' => fake()->randomElement([
                            'Plastic',
                            'Aluminium',
                            'Metal',
                            'ABS',
                        ]),
                    ],
                    [
                        'name' => 'Dimensions',
                        'value' => fake()->randomElement([
                            '10 × 5 × 2 cm',
                            '15 × 8 × 3 cm',
                            '20 × 10 × 4 cm',
                        ]),
                    ],
                    [
                        'name' => 'Weight',
                        'value' => fake()->randomElement([
                            '120 g',
                            '250 g',
                            '500 g',
                            '1.2 kg',
                        ]),
                    ],
                ],

                'price' => $price,

                'sale_price' => $salePrice,

                'condition' => fake()->randomElement([
                    'new',
                    'refurbished',
                    'used',
                ]),

                'color' => fake()->randomElement([
                    'Black',
                    'White',
                    'Blue',
                    'Gray',
                    'Silver',
                    'Red',
                ]),

                'model' => strtoupper(Str::random(8)),

                'warranty' => fake()->randomElement([
                    0,
                    3,
                    6,
                    12,
                    24,
                    36,
                ]),

                'sale_starts_at' => $salePrice
                    ? now()->subDays(rand(1, 5))
                    : null,

                'sale_ends_at' => $salePrice
                    ? now()->addDays(rand(7, 30))
                    : null,

                'featured' => fake()->boolean(30),

                'status' => Product::STATUS_PUBLISHED,

                'published_at' => now(),

                'meta_title' => $title,

                'meta_description' => fake()->sentence(20),
            ]);

            foreach (range(1, rand(1, 3)) as $sortOrder) {

                $imageUrl = $imageUrls[array_rand($imageUrls)];

                $extension = pathinfo(
                    parse_url($imageUrl, PHP_URL_PATH),
                    PATHINFO_EXTENSION
                ) ?: 'jpg';

                $filename = Str::slug($title)
                    . "-{$sortOrder}.{$extension}";

                $media = Media::create([
                    'public_id' => (string) Str::ulid(),
                    'disk' => 'external',
                    'folder' => 'products',
                    'path' => $imageUrl,
                    'url' => $imageUrl,
                    'provider_file_id' => null,
                    'uploaded_by' => null,
                ]);

                ProductImage::create([
                    'product_id' => $product->id,
                    'media_id' => $media->id,
                    'sort_order' => $sortOrder,
                ]);
            }
        }

        $this->command->info('Products seeded successfully 🚀');
    }
}