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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel user
            $table->foreignId('user_id')->constrained('user');
            // Menghubungkan ke tabel produk (pastikan nama tabelnya 'produk')
            $table->foreignId('produk_id')->constrained('produk');
            // Menghubungkan ke tabel pesanan (pastikan nama tabelnya 'pesanan')
            $table->foreignId('pesanan_id')->constrained('pesanan');
            $table->integer('rating'); // Nilai 1-5
            $table->text('ulasan')->nullable(); // Boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};