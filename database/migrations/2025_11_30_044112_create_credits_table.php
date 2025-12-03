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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Mahasiswa
            $table->string('nim')->nullable(); // NIM
            $table->string('role'); // Misal: Backend Dev, Frontend Dev
            $table->string('image_path'); // Foto Profil
            $table->string('description')->nullable(); // Quote atau Deskripsi singkat
            $table->string('github_url')->nullable(); // Link Github/Portfolio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
