<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_list2_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->string('kode');
            $table->text('nama_produk');
            $table->decimal('qty', 12, 2);
            $table->string('uom');
            $table->string('no_coil')->unique();
            $table->string('storage_bin')->nullable();
            $table->date('tanggal');
            $table->string('pengirim')->nullable();
            $table->decimal('panjang', 12, 2);
            $table->dateTime('time');
            $table->string('kondisi');
            $table->string('tujuan');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('MENUNGGU_VALIDASI');
            $table->timestamps();

            $table->foreign('batch_id')->references('id')->on('packing_list2_batches')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_list2_items');
    }
};
