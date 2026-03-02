<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('shipment')) {
            Schema::table('shipment', function (Blueprint $table) {
                $table->string('container')->nullable()->after('forwarding');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('shipment')) {
            Schema::table('shipment', function (Blueprint $table) {
                $table->dropColumn('container');
            });
        }
    }
};

