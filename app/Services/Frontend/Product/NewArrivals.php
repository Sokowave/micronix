<?php

namespace App\Services\Frontend\Product;

use Illuminate\Database\Eloquent\Collection;

class NewArrivals
{
    public function __construct(
        private readonly Index $products,
    ) {}

    public function get(int $limit = 10): Collection
    {
        return $this->products
            ->query()
            ->latest()
            ->limit($limit)
            ->get();
    }
}