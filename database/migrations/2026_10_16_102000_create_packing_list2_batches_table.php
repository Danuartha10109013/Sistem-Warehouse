<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_list2_batches', function (Blueprint $table) {
            $table->id();
            $table->string('kode_batch')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('total_item')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_list2_batches');
    }
};
