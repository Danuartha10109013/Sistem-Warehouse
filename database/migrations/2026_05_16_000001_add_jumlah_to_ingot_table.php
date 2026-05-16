<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('ingot') && !Schema::hasColumn('ingot', 'jumlah')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->string('jumlah', 191)->nullable()->after('jenis');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('ingot') && Schema::hasColumn('ingot', 'jumlah')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->dropColumn('jumlah');
            });
        }
    }
};
