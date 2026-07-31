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
        Schema::create('open_pack_inspection_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('open_pack_inspection_id');
            $table->string('slot_key', 100);
            $table->string('file_path');
            $table->timestamps();
            
            $table->foreign('open_pack_inspection_id', 'fk_opip_inspection')
                  ->references('id')
                  ->on('open_pack_inspections')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_pack_inspection_photos');
    }
};
