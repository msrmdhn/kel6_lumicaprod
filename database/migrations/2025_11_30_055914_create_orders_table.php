<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Relasi (Penting: tabel services & users harus ada dulu)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete(); // Ini yang tadi error

            // Data Utama
            $table->string('booking_id'); // Kode unik buat tracking (contoh: TRX-001)
            $table->string('full_name');  // Nama Pemesan
            $table->string('payment_proof')->nullable(); // Foto bukti bayar
            
            // Status & Info Tambahan
            $table->string('status')->default('pending'); // pending, lunas, selesai
            $table->integer('total_price'); // Total bayar
            
            
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
