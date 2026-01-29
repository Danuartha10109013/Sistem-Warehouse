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
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('deskripsi_produk')->nullable();
            $table->string('kategori_produk')->nullable();
            $table->string('quantity')->nullable();
            $table->string('storage_bin')->nullable();
            $table->date('date_kedatangan')->nullable();
            $table->date('date_keluar')->nullable();
            $table->string('status')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_stock_bahan_baku');
    }
};
