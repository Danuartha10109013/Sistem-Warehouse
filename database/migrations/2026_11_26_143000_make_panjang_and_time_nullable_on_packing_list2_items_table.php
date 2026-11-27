<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->decimal('panjang', 12, 2)->nullable()->change();
            $table->dateTime('time')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->decimal('panjang', 12, 2)->nullable(false)->change();
            $table->dateTime('time')->nullable(false)->change();
        });
    }
};
