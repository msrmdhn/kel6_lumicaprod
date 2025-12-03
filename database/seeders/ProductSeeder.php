<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // KITA HAPUS BARIS 'Product::truncate()' KARENA BIKIN ERROR FOREIGN KEY
        
        Product::insert([
            [
                'name' => 'Personal Shoot',
                'price' => 150000,
                'description' => 'Sesi foto perorangan, durasi 1 jam, 10 edit foto.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Group Photos',
                'price' => 300000,
                'description' => 'Maksimal 5 orang, durasi 2 jam, 20 edit foto.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Couple Session',
                'price' => 250000,
                'description' => 'Sesi foto pasangan, durasi 1.5 jam, konsep romantis.',
                'created_at' => now(), 'updated_at' => now(),
            ]
        ]);
    }
}