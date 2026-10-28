<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('verifikasi_stikers', function (Blueprint $table) {
            $table->date('tanggal_input')->nullable()->index()->after('id');
            $table->boolean('check_produk')->default(false)->after('status_verifikasi');
            $table->boolean('check_lot_no')->default(false)->after('check_produk');
            $table->boolean('check_berat')->default(false)->after('check_lot_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verifikasi_stikers', function (Blueprint $table) {
            $table->dropColumn(['tanggal_input', 'check_produk', 'check_lot_no', 'check_berat']);
        });
    }
};
