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
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->json('checklist_result')->nullable()->after('status');
            $table->string('catatan_verifikasi')->nullable()->after('checklist_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->dropColumn(['checklist_result', 'catatan_verifikasi']);
        });
    }
};
