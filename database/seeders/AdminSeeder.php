<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                 // <--- PENTING: Agar kodingan kenal 'User'
use Illuminate\Support\Facades\Hash; // <--- PENTING: Agar kodingan kenal 'Hash'

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Administrator Lumica',
            'username' => 'admin',
            'email' => 'admin@lumica.com',
            'no_wa' => '081234567890',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);
        
        // Membuat Akun User Biasa (Opsional, buat ngetes aja)
        User::create([
            'name' => 'User Biasa',
            'username' => 'user1',
            'email' => 'user@lumica.com',
            'no_wa' => '08111111111',
            'role' => 'user',
            'password' => Hash::make('password123'),
        ]);
    }
}