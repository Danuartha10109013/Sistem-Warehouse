<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Make columns nullable (MySQL)
        DB::statement("ALTER TABLE `sac` MODIFY `kpc` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `sac` MODIFY `barcode` VARCHAR(255) NULL");
    }

    public function down(): void
    {
        // If rollback, convert nulls to empty string first to avoid NOT NULL error.
        DB::statement("UPDATE `sac` SET `kpc` = '' WHERE `kpc` IS NULL");
        DB::statement("UPDATE `sac` SET `barcode` = '' WHERE `barcode` IS NULL");

        DB::statement("ALTER TABLE `sac` MODIFY `kpc` VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE `sac` MODIFY `barcode` VARCHAR(255) NOT NULL");
    }
};

