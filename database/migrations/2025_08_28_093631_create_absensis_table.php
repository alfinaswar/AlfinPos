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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal');
            $table->time('JamMasuk')->nullable();
            $table->time('JamPulang')->nullable();
            $table->enum('Jenis', ['Masuk', 'Tidak Masuk', 'Libur'])->nullable();
            $table->enum('Status', ['Tepat Waktu', 'Terlambat'])->nullable();
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
        Schema::dropIfExists('absensis');
    }
};
