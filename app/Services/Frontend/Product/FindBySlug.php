<?php

namespace App\Services\Frontend\Product;

use App\Models\Product;

class FindBySlug
{
    public function __construct(
        private readonly Index $products,
    ) {}

    public function get(string $slug): Product
    {
        return $this->products
            ->query()
            ->where('slug', $slug)
            ->firstOrFail();
    }
}