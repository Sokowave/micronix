<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CategoryData extends Data
{
    public function __construct(
        public string $public_id,

        public string $name,
        public string $slug,
        public string $full_name,

        public ?MediaData $image,

        public ?string $meta_title,
        public ?string $meta_description,

        public bool $is_featured,
        public bool $is_active,

        public string $url,
    ) {}
}