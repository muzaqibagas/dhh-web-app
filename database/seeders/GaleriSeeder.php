<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeris')->insert([

            // -------------------------------
            // 1. DOSEN - FOTO
            // -------------------------------
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'DHH menerima Kunjungan Civitas Akademika dari Kangwon National University (KNU), Korea Selatan',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'DHH menerima Kunjungan Civitas Akademika dari Kangwon National University (KNU), Korea Selatan2',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'DHH Menyampaikan Ucapan Selamat Dr. Nat. Techn. Lukmanul Hakim Zaini Telah Resmi Menyelesaikan Studi Doktoral di BOKU University, Austria',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Dosen Departemen Hasil Hutan di OSAKA Expo 2025, Jepang',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/4.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Dosen Departemen Hasil Hutan inisiasi kerjasama dengan University of Tokyo, Japan',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/5.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Dosen Departemen Hasil Hutan Kunjungi Industri Miyamoto Kogyo Co. Ltd, Wakayama – Jepang',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/6.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Dosen IPB University Asal Kabupaten Cianjur Berhasil Ciptakan Genteng dan Kaca yang Ramah Lingkungan',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/7.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'IPB-ULM Rancang Masa Depan Batang Sawit, Potensi Ekonominya Mencengangkan!',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1, // sesuaikan user id kamu
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Studium generale dosen2  dr Univ de Lorraine, Perancis',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/9.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // -------------------------------
            // 2. DOSEN - VIDEO YouTube
            // -------------------------------
            [
                'id_user' => 1,
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Jelajah IPB (Departemen Hasil Hutan, Fakultas Kehutanan dan Lingkungan)',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'video',
                'video' => 'https://youtu.be/KD7f3GAOIts?si=eGpvGapwdF65U4u3',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 1, // kategori DOSEN
                'judul' => 'Video Profile DHH 2023',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'video',
                'video' => 'https://youtu.be/BHqDZpuZ8r4',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // -------------------------------
            // 3. MAHASISWA - FOTO
            // -------------------------------
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Departemen Hasil Hutan Membekali Mahasiswa Tingkat Akhir dengan Sertifikat Kompetensi ISO 9001',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/10.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'DHH Melaksanakan Kuliah Pembekalan PKL TA 20242025 (Angkatan 59)',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/11.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'DHH Menyerahan Mahasiswa PKL TA 2024 (Angkatan 59) di Jawa Barat, Jawa Tengah dan Jawa TImur)',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/12.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'DHH Menyerahan Mahasiswa PKL TA 2024 (Angkatan 59) di Jawa Barat, Jawa Tengah dan Jawa TImur)2',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/13.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'DHH Menyerahan Mahasiswa PKL TA 20242025 (Angkatan 59) di Jawa Barat, Jawa Tengah dan Jawa TImur)',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/14.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Mahasiswa DHH Raih Double Medalist di PIMNAS 37',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/15.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Rombongan Pelajar SMA Kunjungi Laboratorium Departemen Hasil Hutan IPB University',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/16.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Rombongan Pelajar SMA Kunjungi Laboratorium Departemen Hasil Hutan IPB University2',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'gambar',
                'video' => null,
                'gambar' => 'galeri_upload/17.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // -------------------------------
            // 4. MAHASISWA - VIDEO YouTube
            // -------------------------------
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Fakultas Kehutanan dan Lingkungan IPB University, Kenalan dengan Pelestari Hutan Terbaik Indonesia',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'video',
                'video' => 'https://youtu.be/evNrI0f0QiA',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategorigaleri' => 2, // kategori MAHASISWA
                'judul' => 'Jelajah Fakultas Kehutanan dan Lingkungan IPB University',
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => 'video',
                'video' => 'https://youtu.be/jSWJH4XDZUM',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
