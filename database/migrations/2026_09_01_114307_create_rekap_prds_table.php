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
        Schema::create('rekap_prds', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->integer('hasil_prd')->default(0);
            $table->integer('pengeluaran_tml')->default(0);
            $table->integer('pengeluaran_ttl')->default(0);
            $table->integer('total_pengeluaran')->default(0);
            $table->integer('sisa_stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_prds');
    }
};
