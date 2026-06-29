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
            // Tambahkan baris di bawah ini:
            $table->string('nama_produk'); // Untuk menyimpan nama produk
            $table->integer('rating');     // Untuk menyimpan angka bintang (1-5)
            $table->text('komentar');      // Untuk menyimpan isi ulasan
            // -----------------------------
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
