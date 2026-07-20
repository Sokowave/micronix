<?php

namespace App\Data;

use Spatie\LaravelData\Data;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]

class MediaData extends Data
{
    public function __construct(
        public string $public_id,
        public ?string $url,
    ) {}
}