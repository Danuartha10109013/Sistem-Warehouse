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
        Schema::create('kode_produk_bb', function (Blueprint $table) {
            $table->id();
            $table->string('supplier')->nullable();
            $table->string('kode_produk')->nullable();
            $table->string('kategori')->nullable();
            $table->string('origin')->nullable();
            $table->string('attribute_code')->nullable();
            $table->string('jenis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_produk_bb');
    }
};
