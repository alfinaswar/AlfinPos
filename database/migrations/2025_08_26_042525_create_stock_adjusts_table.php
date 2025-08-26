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
        Schema::create('stock_adjusts', function (Blueprint $table) {
            $table->id();
            $table->string('KodeSo')->nullable();
            $table->date('Tanggal')->nullable();
            $table->text('Alasan')->nullable();
            $table->string('Petugas')->nullable();
            $table->enum('Status', ['Y', 'N'])->nullable();
            $table->dateTime('ApproveAt')->nullable();
            $table->string('ApproveBy')->nullable();
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
        Schema::dropIfExists('stock_adjusts');
    }
};
