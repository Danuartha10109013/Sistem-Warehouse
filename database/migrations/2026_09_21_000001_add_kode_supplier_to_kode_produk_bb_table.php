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
        if (Schema::hasTable('kode_produk_bb') && !Schema::hasColumn('kode_produk_bb', 'kode_supplier')) {
            Schema::table('kode_produk_bb', function (Blueprint $table) {
                $table->string('kode_supplier')->nullable()->after('kode_produk');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kode_produk_bb') && Schema::hasColumn('kode_produk_bb', 'kode_supplier')) {
            Schema::table('kode_produk_bb', function (Blueprint $table) {
                $table->dropColumn('kode_supplier');
            });
        }
    }
};
