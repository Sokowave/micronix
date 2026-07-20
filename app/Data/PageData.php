<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PageData extends Data
{
    public function __construct(
        public string $title,
        public string $slug,

        public string $content,

        public ?string $seo_title,
        public ?string $seo_description,

        public bool $is_published,

        public string $url,
    ) {}
}