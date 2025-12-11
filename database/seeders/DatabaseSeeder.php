<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Staff
        $staff1 = User::create([
            'name' => 'Staff 1',
            'email' => 'staff1@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $staff2 = User::create([
            'name' => 'Staff 2',
            'email' => 'staff2@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create Guest
        $guest = User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('password'),
            'role' => 'guest',
        ]);

        // Create Sample Projects
        Proyek::create([
            'judul' => 'Sistem Monitoring Hasil Proyek Akhir',
            'deskripsi' => 'Aplikasi web untuk monitoring dan manajemen hasil proyek akhir mahasiswa dengan fitur CRUD lengkap, authentication, dan role-based access control.',
            'mahasiswa_nim' => '1234567890',
            'mahasiswa_nama' => 'John Doe',
            'dosen_pembimbing' => 'Dr. Jane Smith',
            'status' => 'completed',
            'tanggal_mulai' => '2024-01-01',
            'tanggal_selesai' => '2024-06-30',
            'progress' => 100,
            'catatan' => 'Proyek telah selesai dengan baik',
            'user_id' => $staff1->id,
        ]);

        Proyek::create([
            'judul' => 'Aplikasi E-Commerce dengan Laravel',
            'deskripsi' => 'Pengembangan aplikasi e-commerce menggunakan framework Laravel dengan fitur payment gateway dan inventory management.',
            'mahasiswa_nim' => '0987654321',
            'mahasiswa_nama' => 'Jane Doe',
            'dosen_pembimbing' => 'Prof. John Smith',
            'status' => 'on_progress',
            'tanggal_mulai' => '2024-02-01',
            'tanggal_selesai' => null,
            'progress' => 65,
            'catatan' => 'Sedang dalam tahap pengujian',
            'user_id' => $staff2->id,
        ]);

        Proyek::create([
            'judul' => 'Sistem Manajemen Perpustakaan',
            'deskripsi' => 'Aplikasi untuk mengelola peminjaman buku, anggota perpustakaan, dan inventaris buku dengan fitur reporting.',
            'mahasiswa_nim' => '1122334455',
            'mahasiswa_nama' => 'Alice Johnson',
            'dosen_pembimbing' => 'Dr. Bob Williams',
            'status' => 'pending',
            'tanggal_mulai' => null,
            'tanggal_selesai' => null,
            'progress' => 0,
            'catatan' => 'Menunggu persetujuan',
            'user_id' => null,
        ]);

        Proyek::create([
            'judul' => 'Aplikasi Mobile untuk Monitoring Kesehatan',
            'deskripsi' => 'Aplikasi mobile untuk monitoring kesehatan harian dengan fitur tracking aktivitas, kalori, dan reminder minum obat.',
            'mahasiswa_nim' => '5566778899',
            'mahasiswa_nama' => 'Bob Brown',
            'dosen_pembimbing' => 'Dr. Alice Davis',
            'status' => 'completed',
            'tanggal_mulai' => '2023-09-01',
            'tanggal_selesai' => '2024-01-31',
            'progress' => 100,
            'catatan' => 'Aplikasi telah di-deploy ke Play Store',
            'user_id' => $staff1->id,
        ]);
    }
}
