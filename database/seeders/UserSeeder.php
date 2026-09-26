<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Administrator',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        User::updateOrCreate(['email' => 'staff@example.com'], [
            'name' => 'Staff Member',
            'password' => Hash::make('password123'),
            'role' => 'staff'
        ]);
    }
}
