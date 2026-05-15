<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('resin') && !Schema::hasColumn('resin', 'jalan')) {
            Schema::table('resin', function (Blueprint $table) {
                $table->string('jalan')->nullable()->after('jenis');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('resin') && Schema::hasColumn('resin', 'jalan')) {
            Schema::table('resin', function (Blueprint $table) {
                $table->dropColumn('jalan');
            });
        }
    }
};
