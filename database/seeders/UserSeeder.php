<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmins =
            [
                [
                    'name' => 'Super admin',
                    'email' => 'superadmin@test.com',
                    'password' => Hash::make('admin')
                ]
            ];

        $admins =
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@test.com',
                    'password' => Hash::make('admin')
                ]
            ];

        $users = [
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'password' => Hash::make('admin')
            ]
        ];


        foreach ($superAdmins as $superAdmin) {
            $superAdmin['is_admin'] = true;
            User::create($superAdmin);
        }

        foreach ($admins as $admin) {
            User::create($admin);
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
