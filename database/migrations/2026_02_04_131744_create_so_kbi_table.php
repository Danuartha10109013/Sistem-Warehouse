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
        Schema::create('so_kbi', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('so')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('coil_no')->nullable();
            $table->integer('delv_weight')->nullable();
            $table->string('thick')->nullable();
            $table->string('thicknes')->nullable();
            $table->string('width_batch')->nullable();
            $table->string('storagebin_kbi')->nullable();
            $table->string('status')->nullable();

            $table->string('coil_scan')->nullable();
            $table->string('weight_scan')->nullable();
            $table->dateTime('waktu_scan')->nullable();
            $table->string('scanner')->nullable();

            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('so_kbi');
    }
};
