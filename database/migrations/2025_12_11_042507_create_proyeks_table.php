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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('mahasiswa_nim');
            $table->string('mahasiswa_nama');
            $table->string('dosen_pembimbing');
            $table->enum('status', ['pending', 'on_progress', 'completed', 'rejected'])->default('pending');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('progress')->default(0);
            $table->text('catatan')->nullable();
            $table->string('file_dokumen')->nullable();
            // Simpan lampiran sebagai teks agar kompatibel dengan MySQL/MariaDB lama yang belum mendukung tipe JSON
            $table->text('file_lampiran')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // staff yang mengelola
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
