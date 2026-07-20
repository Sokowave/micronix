<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]

class ProductCardData extends Data
{
    public function __construct(
        public string $public_id,
        public string $title,
        public string $slug,

        public float $current_price,
        public ?float $sale_price,

        public bool $has_discount,
        public ?int $discount_percentage,

        public string $formatted_price,
        public string $formatted_original_price,

        public ?MediaData $primary_image,

        public string $url,
    ) {}
}