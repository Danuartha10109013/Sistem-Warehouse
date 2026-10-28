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
        Schema::create('verifikasi_stikers', function (Blueprint $table) {
            $table->id();
            $table->string('produk');
            $table->string('attribute')->index();
            $table->string('supplier_lot_no');
            $table->string('tgl_dn')->nullable();
            $table->decimal('berat', 12, 2)->default(0);
            $table->string('status_verifikasi')->default('belum'); // belum, sesuai, tidak_sesuai
            $table->timestamp('verified_at')->nullable();
            $table->string('verified_by')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_stikers');
    }
};
