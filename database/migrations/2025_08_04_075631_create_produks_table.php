<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('KodeBarang')->nullable();
            $table->string('Nama')->nullable();
            $table->string('KategoriItem')->nullable();
            $table->string('JenisItem')->nullable();
            $table->string('Satuan')->nullable();
            $table->string('HargaModal')->nullable();
            $table->string('HargaJual')->nullable();
            $table->string('Stok')->nullable();
            $table->longText('Deskripsi')->nullable();
            $table->string('Gambar')->nullable();
            $table->string('Status')->nullable();
            $table->string('UserCreate')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
