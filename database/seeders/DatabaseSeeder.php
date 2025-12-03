<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Panggil Seeder Lainnya
use Database\Seeders\AdminSeeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil AdminSeeder & ProductSeeder SEKALIGUS
        $this->call([
            AdminSeeder::class,
            ProductSeeder::class, // <--- INI WAJIB ADA AGAR PAKET MUNCUL
        ]);
    }
}