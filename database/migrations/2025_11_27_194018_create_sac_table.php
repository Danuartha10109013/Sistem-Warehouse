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
        Schema::create('sac', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('warehouse');
            $table->string('kpc');
            $table->string('barcode');
            $table->string('namabarang');
            $table->decimal('berat', 10, 2); // bisa disesuaikan presisi
            $table->string('lokasi');

            $table->string('jenis');

            $table->date('date_scan')->nullable();
            $table->string('lokasi_scan')->nullable();
            $table->string('qty_scan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('scanner')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packings');
    }
};
