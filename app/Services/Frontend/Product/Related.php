<?php

namespace App\Services\Frontend\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class Related
{
    public function __construct(
        private readonly Index $products,
    ) {}

    public function get(Product $product, int $limit = 5): Collection
    {
        return $this->products
            ->query()
            ->whereKeyNot($product->getKey())
            ->where('category_id', $product->category_id)
            ->latest()
            ->limit($limit)
            ->get();
    }
}