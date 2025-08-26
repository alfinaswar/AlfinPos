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
        Schema::create('stock_ajust_details', function (Blueprint $table) {
            $table->id();
            $table->string('IdSo')->nullable();
            $table->string('IdProduk')->nullable();
            $table->string('StokAwal')->nullable();
            $table->string('StokAkhir')->nullable();
            $table->string('Penyesuaian')->nullable();
            $table->enum('Jenis', ['Penambahan', 'Pengurangan'])->nullable();
            $table->string('UserCreate')->nullable();
            $table->string('UserUpdate')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ajust_details');
    }
};
