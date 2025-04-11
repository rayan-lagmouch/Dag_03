<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        $roles = ['guest', 'member', 'employee', 'administrator', 'customer'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Seed users with roles
        $users = [
            [
                'name' => 'Employee User',
                'email' => 'employee@bowling.com',
                'role' => 'employee',
            ],
            [
                'name' => 'Customer User',
                'email' => 'customer@bowling.com',
                'role' => 'customer',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@bowling.com',
                'role' => 'administrator',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // default password
            ]);

            // Assign the role to the user
            $user->assignRole($userData['role']);
        }
    }
}
