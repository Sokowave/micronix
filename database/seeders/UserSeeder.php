<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Micronix Super Admin',
                'email' => 'superadmin@micronix.co.ke',
                'phone' => null,
                'role' => 'superadmin',
            ],
            [
                'name' => 'Micronix Admin',
                'email' => 'admin@micronix.co.ke',
                'phone' => null,
                'role' => 'admin',
            ],
            [
                'name' => 'Micronix Customer',
                'email' => 'customer@micronix.co.ke',
                'phone' => null,
                'role' => 'customer',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'role' => $user['role'],
                    'email_verified_at' => now(),
                    'phone_verified_at' => null,
                    'password' => '123456789',
                ]
            );
        }
    }
}

//php artisan migrate:fresh --seed