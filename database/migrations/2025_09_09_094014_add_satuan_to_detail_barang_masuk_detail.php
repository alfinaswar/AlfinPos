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
        Schema::table('barang_masuk_details', function (Blueprint $table) {
            $table->string('IdSatuan')->nullable()->after('Qty');
            $table->string('NamaSatuan')->nullable()->after('IdSatuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuk_details', function (Blueprint $table) {
            //
        });
    }
};
