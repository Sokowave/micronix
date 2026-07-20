<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's users.
     */
    public function run(): void
    {
        $users = [
            [
                'user_type' => 'superadmin',
                'f_name' => 'Super',
                'l_name' => 'Admin',
                'email' => 'superadmin@kasiodc.co.ke',
                'phone' => '0700000001',
            ],
            [
                'user_type' => 'staff',
                'f_name' => 'John',
                'l_name' => 'Staff',
                'email' => 'staff@kasiodc.co.ke',
                'phone' => '0700000002',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'user_type' => $data['user_type'],

                    'f_name' => $data['f_name'],
                    'l_name' => $data['l_name'],

                    'phone' => $data['phone'],

                    'status' => 'active',

                    'password' => Hash::make('12345678'),
                ]
            );
        }
    }
}