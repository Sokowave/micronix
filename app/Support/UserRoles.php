<?php

namespace App\Support;

class UserRoles
{
    public const SUPERADMIN = 'superadmin';

    public const ADMIN = 'admin';

    public const CUSTOMER = 'customer';

    public const BACKOFFICE = [
        self::SUPERADMIN,
        self::ADMIN,
    ];
}