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
        Schema::create('scan_koil_eups', function (Blueprint $table) {
            $table->id();
            $table->string('no_coil_eup');
            $table->unsignedBigInteger('palet_id')->nullable();
            $table->unsignedBigInteger('layout_id');
            $table->decimal('berat', 10, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('palet_id')->references('id')->on('scan_koil_palets')->onDelete('set null');
            $table->foreign('layout_id')->references('id')->on('scan_koil_layouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_koil_eups');
    }
};
