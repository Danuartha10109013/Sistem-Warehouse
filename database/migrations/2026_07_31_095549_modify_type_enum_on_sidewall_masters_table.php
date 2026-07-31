<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE sidewall_masters MODIFY COLUMN type ENUM('size_id', 'size_od', 'size_sidewall', 'tujuan', 'shift') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE sidewall_masters MODIFY COLUMN type ENUM('size_id', 'size_od', 'tujuan', 'shift') NOT NULL");
    }
};
