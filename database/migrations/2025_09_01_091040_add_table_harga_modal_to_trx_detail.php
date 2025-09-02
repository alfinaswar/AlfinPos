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
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->string('HargaModal')->nullable()->after('Qty');
            $table->string('HargaGrosir')->nullable()->after('HargaSatuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            //
        });
    }
};
