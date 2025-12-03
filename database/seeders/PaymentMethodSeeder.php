<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethod::create([
            'bank_name' => 'Bank Muamalat',
            'account_number' => '123-456-7890',
            'account_holder' => 'Lumica Project',
        ]);

        PaymentMethod::create([
            'bank_name' => 'Bank Mandiri',
            'account_number' => '987-654-3210',
            'account_holder' => 'Lumica Project',
        ]);

        PaymentMethod::create([
            'bank_name' => 'Bank BCA',
            'account_number' => '555-555-5555',
            'account_holder' => 'Lumica Project',
        ]);
    }
}