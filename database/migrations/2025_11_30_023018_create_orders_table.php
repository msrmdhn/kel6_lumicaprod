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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Akun login
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Paket

            // DATA PEMESAN (YANG BARU)
            $table->string('recipient_name'); // Nama Pemesan (Bisa diedit)
            $table->string('delivery_email'); // Email Pengiriman
            $table->string('backup_no_wa');   // WA Cadangan
            
            $table->date('booking_date');
            $table->string('payment_method');
            $table->string('payment_proof')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
