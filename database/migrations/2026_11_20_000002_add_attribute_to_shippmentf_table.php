<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shippmentf', function (Blueprint $table) {
            $table->string('attribute', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('shippmentf', function (Blueprint $table) {
            $table->dropColumn('attribute');
        });
    }
};
