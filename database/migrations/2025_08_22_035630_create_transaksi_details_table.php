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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->string('IdTransaksi')->nullable();
            $table->string('IdProduk')->nullable();
            $table->string('Qty')->nullable();
            $table->string('HargaSatuan')->nullable();
            $table->string('Subtotal')->nullable();
            $table->string('TipeDiskon')->nullable();
            $table->string('Diskon')->nullable();
            $table->string('TotalAkhir')->nullable();
            $table->string('IdKasir')->nullable();
            $table->string('Shift')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
