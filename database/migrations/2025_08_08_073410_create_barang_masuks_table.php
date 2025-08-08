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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('KodeBm')->nullable();
            $table->date('Tanggal')->nullable();
            $table->string('Supplier')->nullable();
            $table->string('Invoice')->nullable();
            $table->text('Keterangan')->nullable();
            $table->string('Total')->nullable();
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
        Schema::dropIfExists('barang_masuks');
    }
};
