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
        Schema::create('packing_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');                 // Date input
            $table->string('attribute');              // Scan / input manual
            $table->string('group');                  // Group A/B/C Lokal
            $table->string('layout');                 // Custom searchable dropdown
            $table->string('no_so');                // Optional No SO
            $table->string('kondisi');                // Baik / Damage Release QA
            $table->string('plastik');                // PE & VCI
            $table->string('wrapping');               // Wrapping
            $table->string('impraboard');             // Impraboard
            $table->string('idod');                   // ID & OD
            $table->string('pallet');                 // Pallet
            $table->string('bandazer');               // Ikatan bandazer
            $table->timestamps();                     // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_reports');
    }
};
