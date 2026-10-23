<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packing_list2_batches', function (Blueprint $table) {
            if (!Schema::hasColumn('packing_list2_batches', 'no_rit')) {
                $table->string('no_rit')->nullable()->after('kode_batch');
            }
        });
    }

    public function down(): void
    {
        Schema::table('packing_list2_batches', function (Blueprint $table) {
            $table->dropColumn('no_rit');
        });
    }
};
