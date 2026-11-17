<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('break_bulks', function (Blueprint $table) {
            $table->id();
            $table->integer('no_urut')->nullable();
            $table->string('atribut')->index();
            $table->decimal('weight', 12, 2)->default(0);
            $table->string('product');
            $table->string('no_so')->nullable();
            $table->string('status')->default('pending'); // pending, scanned, loaded
            $table->timestamp('scanned_at')->nullable();
            $table->unsignedBigInteger('scanned_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('break_bulks');
    }
};
