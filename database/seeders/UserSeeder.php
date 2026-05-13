<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@blogyaari.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Lead architect and system administrator of BlogYaari.',
        ]);

        User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
            'role' => 'author',
            'bio' => 'Passionate tech writer and developer.',
        ]);
    }
}
