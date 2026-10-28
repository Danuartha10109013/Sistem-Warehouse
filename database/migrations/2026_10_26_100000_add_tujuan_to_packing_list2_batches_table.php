<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packing_list2_batches', function (Blueprint $table) {
            if (!Schema::hasColumn('packing_list2_batches', 'tujuan')) {
                $table->string('tujuan', 50)->nullable()->after('no_rit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('packing_list2_batches', function (Blueprint $table) {
            if (Schema::hasColumn('packing_list2_batches', 'tujuan')) {
                $table->dropColumn('tujuan');
            }
        });
    }
};
