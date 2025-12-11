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
        // Kolom role sudah dibuat di migration awal create_users_table.
        // Tidak perlu menambah apa-apa di sini untuk kompatibilitas MySQL/MariaDB lama.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada perubahan yang perlu dibalik.
    }
};
