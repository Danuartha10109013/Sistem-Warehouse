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
        Schema::table('sidewall', function (Blueprint $table) {
            $table->dropColumn([
                'size_id',
                'jumlah_id',
                'jumlah_id_ng',
                'size_od',
                'jumlah_od',
                'jumlah_od_ng'
            ]);
            
            $table->string('size_sidewall')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidewall', function (Blueprint $table) {
            $table->string('size_id')->nullable();
            $table->integer('jumlah_id')->default(0);
            $table->integer('jumlah_id_ng')->default(0);
            $table->string('size_od')->nullable();
            $table->integer('jumlah_od')->default(0);
            $table->integer('jumlah_od_ng')->default(0);
            
            $table->dropColumn('size_sidewall');
        });
    }
};
