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
        Schema::create('konversi_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdProduk');
            $table->string('Satuan')->nullable();
            $table->integer('Isi')->nullable();
            $table->string('HargaModal')->nullable();
            $table->string('HargaJual')->nullable();
            $table->string('UserCreate', 100)->nullable();
            $table->string('UserUpdate', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversi_items');
    }
};
