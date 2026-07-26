<?php

namespace App\Services\Frontend\Product;

use Illuminate\Database\Eloquent\Collection;

class Featured
{
    public function __construct(
        private readonly Index $products,
    ) {}

    public function get(int $limit = 10): Collection
    {
        return $this->products
            ->query()
            ->where('is_featured', true)
            ->latest()
            ->limit($limit)
            ->get();
    }
}