<?php

namespace App\Data\Auth;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AuthenticatedUserData extends Data
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
        public string $user_type,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            entry_no: $user->entry_no,
            f_name: $user->f_name,
            l_name: $user->l_name,
            name: $user->name,
            name_initials: $user->name_initials,
            email: $user->email,
            phone: $user->phone,
            status: $user->status,
            user_type: $user->user_type,
        );
    }
}