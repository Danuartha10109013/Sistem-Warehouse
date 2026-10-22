<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->dropUnique(['no_coil']);
            $table->index('no_coil'); // Ubah menjadi index biasa agar query tetap cepat
        });
    }

    public function down(): void
    {
        Schema::table('packing_list2_items', function (Blueprint $table) {
            $table->dropIndex(['no_coil']);
            $table->unique('no_coil');
        });
    }
};
