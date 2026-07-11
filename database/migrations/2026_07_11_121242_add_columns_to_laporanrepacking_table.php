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
        Schema::table('laporanrepacking', function (Blueprint $table) {
            $table->string('ukuran')->nullable();
            $table->string('berat')->nullable();
            $table->string('layout')->nullable();
        });

        Schema::dropIfExists('daftar_repackings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporanrepacking', function (Blueprint $table) {
            $table->dropColumn(['ukuran', 'berat', 'layout']);
        });

        Schema::create('daftar_repackings', function (Blueprint $table) {
            $table->id();
            $table->string('atribute')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('berat')->nullable();
            $table->string('layout')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }
};
