<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('ingot') && !Schema::hasColumn('ingot', 'jalan')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->string('jalan')->nullable()->after('shift_leader');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('ingot') && Schema::hasColumn('ingot', 'jalan')) {
            Schema::table('ingot', function (Blueprint $table) {
                $table->dropColumn('jalan');
            });
        }
    }
};
