<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public string $entry_no,

        public string $f_name,
        public string $l_name,

        public string $name,
        public string $name_initials,

        public string $email,
        public ?string $phone,

        public string $status,
    ) {}
}