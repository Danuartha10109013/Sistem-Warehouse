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
        Schema::create('laporanrepacking', function (Blueprint $table) {
            $table->id();
            $table->string('atributte');
            $table->string('tanggal')->nullable();
            $table->string('status')->nullable();
            $table->string('group')->nullable();
            $table->string('wrapping')->nullable();
            $table->string('vcipaper')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporanrepacking');
    }
};
