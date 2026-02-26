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
        // Tambah kolom metode_unloading dan note_keseluruhan ke tabel crc
        if (Schema::hasTable('crc')) {
            Schema::table('crc', function (Blueprint $table) {
                // Nullable supaya data lama tetap aman, form sudah mengatur required untuk input baru
                $table->string('metode_unloading')->nullable()->after('supplier');
                $table->text('note_keseluruhan')->nullable()->after('time_last');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('crc')) {
            Schema::table('crc', function (Blueprint $table) {
                if (Schema::hasColumn('crc', 'metode_unloading')) {
                    $table->dropColumn('metode_unloading');
                }
                if (Schema::hasColumn('crc', 'note_keseluruhan')) {
                    $table->dropColumn('note_keseluruhan');
                }
            });
        }
    }
};

