<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('open_pack_inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crc_id')->nullable();
            $table->string('attribute')->nullable();
            $table->string('nomor_coil_supplier')->nullable();
            $table->date('tanggal_kedatangan')->nullable();
            $table->string('nomor_surat_jalan')->nullable();
            $table->string('nama_supplier')->nullable();
            $table->date('tanggal_open_pack')->nullable();
            $table->string('grup', 1)->nullable(); // A, B, C, D
            $table->string('kondisi_awal', 20)->nullable(); // OK, NOT_GOOD
            $table->string('kondisi_setelah_open_pack', 20)->nullable(); // OK, NOT_GOOD
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('open_pack_inspections');
    }
};
