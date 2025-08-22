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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // Informasi Transaksi Dasar
            $table->string('Kode', 50)->unique(); // Nomor invoice/struk
            $table->datetime('Tanggal');

            // Relasi dengan tabel lain
            $table->string('IdKasir');
            $table->string('IdOutlet')->nullable();
            $table->string('Subtotal')->nullable();
            $table->string('TotalDiskon')->nullable();
            $table->string('Pajak')->nullable();
            $table->string('BiayaLayanan')->nullable();
            $table->string('TotalAkhir')->nullable();
            $table->string('JumlahBayar')->nullable();
            $table->string('kembalian')->nullable();
            $table->string('MetodePembayaran')->nullable();

            // Status Transaksi
            $table->enum('status_transaksi', [
                'Pending',
                'Berhasil',
                'Dibatalkan',
                'Refund Sebagian',
                'Refund Penuh'
            ])->default('Pending');

            // Informasi Diskon
            $table->enum('JenisDiskon', ['Persentase', 'Nominal', 'None'])->default('None');
            $table->string('NilaiDiskon', 15, 2)->default(0);

            // Detail Tambahan
            $table->text('Catatan')->nullable(); // Catatan khusus
            $table->string('JumlahItem')->default(0);

            // Tracking & Audit
            $table->boolean('IdVoid')->default(false);
            $table->datetime('VoidAt')->nullable();
            $table->string('VoidBy')->nullable();
            $table->text('AlasanVoid')->nullable();
            $table->string('Shift', 20)->nullable();
            $table->string('NamaCustomer', 200)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
