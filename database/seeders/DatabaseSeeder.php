<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // ganti di production
            'role' => 'admin',
        ]);

        // Konselor
        User::create([
            'name' => 'Konselor 1',
            'email' => 'konselor@example.com',
            'password' => Hash::make('password'),
            'role' => 'konselor',
        ]);

        // Kader
        User::create([
            'name' => 'Kader 1',
            'email' => 'kader@example.com',
            'password' => Hash::make('password'),
            'role' => 'kader',
        ]);
    }
}
