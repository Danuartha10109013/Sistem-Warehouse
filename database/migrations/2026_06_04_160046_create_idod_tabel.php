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
        Schema::create('idod_tabel', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('size_id');
            $table->integer('jumlah_id');
            $table->integer('jumlah_id_ng')->default(0);
            $table->string('size_od');
            $table->integer('jumlah_od');
            $table->integer('jumlah_od_ng')->default(0);
            $table->string('tujuan'); // Sadang | Exspor | Lokal
            $table->string('keterangan')->nullable();
            $table->string('shift'); // Group A | Group B
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idod_tabel');
    }
};
