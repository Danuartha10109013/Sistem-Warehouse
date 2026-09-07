<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_timbangans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->float('label');
            $table->float('actual');
            $table->float('selisih');
            $table->string('status', 20); // 'OK' atau 'NOT OK'
            
            // Kolom kalibrasi (nullable)
            $table->string('tindak_lanjut')->nullable();
            $table->float('actual_setelah')->nullable();
            $table->float('selisih_setelah')->nullable();
            
            // Relasi atau nama operator
            $table->string('operator_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasi_timbangans');
    }
};
