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
        // Menambahkan nilai 'open' dan 'close' ke enum status
        DB::statement("ALTER TABLE `tickets` MODIFY `status` ENUM('pending','in_progress','resolved','open','close') NOT NULL DEFAULT 'pending';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan enum ke keadaan semula jika rollback
        DB::statement("ALTER TABLE `tickets` MODIFY `status` ENUM('pending','in_progress','resolved') NOT NULL DEFAULT 'pending';");
    }
};
