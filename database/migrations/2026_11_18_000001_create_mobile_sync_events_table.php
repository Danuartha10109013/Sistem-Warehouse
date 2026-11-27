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
        Schema::create('mobile_sync_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('event_id')->unique(); // UUID unik dari client
            $table->string('module', 50)->index(); // verifikasi_stiker, packing_list_2, dll
            $table->string('aggregate_id', 100)->index(); // ID entitas (id stiker, no koil, id item)
            $table->string('event_type', 50)->index(); // STIKER_VERIFIED, COIL_VALIDATED, dll
            $table->json('payload'); // Data perubahan
            $table->string('device_id', 100)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('client_timestamp', 3); // Waktu di perangkat mobile (milidetik)
            $table->dateTime('synced_at', 3)->nullable(); // Waktu diterima server
            $table->enum('status', ['APPLIED', 'REJECTED', 'CONFLICT'])->default('APPLIED');
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_sync_events');
    }
};
