<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sac', function (Blueprint $table) {
            $table->integer('berat')->change();
        });
    }

    public function down(): void
    {
        Schema::table('sac', function (Blueprint $table) {
            $table->decimal('berat', 10, 2)->change();
        });
    }
};
