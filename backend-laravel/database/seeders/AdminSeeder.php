<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Enums\AdminRole;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name'  => 'Super Admin',
                'email' => 'super@admin.com',
                'role'  => AdminRole::SUPER_ADMIN,
            ],
            [
                'name'  => 'Admin',
                'email' => 'admin@admin.com',
                'role'  => AdminRole::ADMIN,
            ],
            [
                'name'  => 'Staff',
                'email' => 'staff@admin.com',
                'role'  => AdminRole::STAFF,
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name'              => $admin['name'],
                    'password'          => Hash::make('password'),
                    'role'              => $admin['role'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}