<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin
        User::create([
            'name' => 'Admin Rafa',
            'email' => 'admin@rafa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3 Petugas
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@rafa.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@rafa.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Agus Pratama',
            'email' => 'agus@rafa.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);
    }
}
