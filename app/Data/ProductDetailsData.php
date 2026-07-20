<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProductDetailsData extends Data
{
    public function __construct(
        public string $public_id,

        public string $title,
        public string $slug,

        public ?string $short_description,

        public ?string $description,

        /** @var array<int, array{name:string, value:string}> */
        public array $specifications,

        public string $sku,

        public int $stock,

        public ?string $condition,
        public ?string $color,
        public ?string $model,
        public ?int $warranty,

        public float $price,
        public ?float $sale_price,
        public float $current_price,

        public bool $has_discount,
        public float $discount_amount,
        public ?int $discount_percentage,
        public float $savings,

        public string $formatted_price,
        public string $formatted_original_price,
        public string $formatted_savings,

        public ?MediaData $primary_image,

        /** @var MediaData[] */
        public array $images,

        public string $url,
    ) {}
}