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
        Schema::table('kategori_items', function (Blueprint $table) {
            $table->enum('Visible', ['Y', 'N'])->nullable()->default('Y')->after('Icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_items', function (Blueprint $table) {
            //
        });
    }
};
