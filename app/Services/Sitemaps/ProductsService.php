<?php

namespace App\Services\Sitemaps;

use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class ProductsService
{
    public function generate(): Sitemap
    {
        $sitemap = Sitemap::create();

        Product::published()
            ->orderBy('id')
            ->chunk(200, function ($products) use ($sitemap) {

                foreach ($products as $product) {

                    $sitemap->add(
                        Url::create(route('product.show', $product))
                            ->setLastModificationDate($product->updated_at)
                            ->setPriority(0.8)
                    );
                }
            });

        return $sitemap;
    }
}