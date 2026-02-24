<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('ingot')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->time('time_awal_bongkar')->nullable()->after('time');
                $table->time('time_akhir_bongkar')->nullable()->after('time_awal_bongkar');
            });
        }
        if (Schema::hasTable('resin')) {
            Schema::table('resin', function (Blueprint $table) {
                $table->time('time_awal_bongkar')->nullable()->after('time');
                $table->time('time_akhir_bongkar')->nullable()->after('time_awal_bongkar');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('ingot')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->dropColumn(['time_awal_bongkar', 'time_akhir_bongkar']);
            });
        }
        if (Schema::hasTable('resin')) {
            Schema::table('resin', function (Blueprint $table) {
                $table->dropColumn(['time_awal_bongkar', 'time_akhir_bongkar']);
            });
        }
    }
};
