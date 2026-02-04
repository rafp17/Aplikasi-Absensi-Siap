<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk keamanan password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user admin untuk login pertama kali
        User::factory()->create([
            'name' => 'Administrator PLT PLH',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Password yang akan digunakan
        ]);
    }
}