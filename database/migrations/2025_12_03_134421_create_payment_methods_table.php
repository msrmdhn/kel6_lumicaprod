<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name'); // Misal: BCA, Mandiri
            $table->string('account_number'); // Misal: 1234567890
            $table->string('account_holder'); // Misal: a.n Lumica Project
            $table->string('logo_path')->nullable(); // (Opsional) Logo Bank
            $table->boolean('is_active')->default(true); // Biar bisa dimatiin sementara
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
