<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('crc') && !Schema::hasColumn('crc', 'jalan')) {
            Schema::table('crc', function (Blueprint $table) {
                $table->string('jalan')->nullable()->after('cuaca');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('crc') && Schema::hasColumn('crc', 'jalan')) {
            Schema::table('crc', function (Blueprint $table) {
                $table->string('jalan')->default('Sesuai')->change();
            });
        }
    }
};
