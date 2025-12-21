<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Administrator',
            'email' => 'admin@sekolah.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Panitia PPDB / Voting
        User::create([
            'name' => 'Panitia PPDB',
            'email' => 'panitia@sekolah.id',
            'password' => Hash::make('password'),
            'role' => 'panitia',
        ]);

        // User Dummy
        User::create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@sekolah.id',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
