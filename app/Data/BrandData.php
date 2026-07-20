<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BrandData extends Data
{
    public function __construct(
        public string $name,
        public string $slug,

        public ?MediaData $logo,

        public ?string $meta_title,
        public ?string $meta_description,

        public string $status,

        public string $url,
    ) {}
}