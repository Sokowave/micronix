<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductCheckoutData extends Data
{
    public function __construct(
        public string $public_id,

        public string $title,

        public string $slug,

        public string $sku,

        public int $stock,

        public float $current_price,

        public string $formatted_price,

        public ?MediaData $primary_image,

        public string $url,
    ) {}
}