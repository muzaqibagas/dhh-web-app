<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            //matakuliah
            ['nama' => 'Kompetensi Umum', 'tipe' => 'matakuliah'],
            ['nama' => 'Kompetensi Dasar Program Studi', 'tipe' => 'matakuliah'],
            ['nama' => 'Kompetensi Program Studi', 'tipe' => 'matakuliah'],
            ['nama' => 'Minat Program Studi', 'tipe' => 'matakuliah'],
            ['nama' => 'Pengayaan', 'tipe' => 'matakuliah'],
            ['nama' => 'Tugas Akhir', 'tipe' => 'matakuliah'],

            //galeri
            ['nama' => 'Akademik', 'tipe' => 'galeri'],
            ['nama' => 'Fasilitas', 'tipe' => 'galeri'],
            ['nama' => 'Prestasi', 'tipe' => 'galeri'],
            ['nama' => 'Kegiatan', 'tipe' => 'galeri'],
            ['nama' => 'SDGS', 'tipe' => 'galeri'],

            //staffdept
            ['nama' => 'Struktur Organisasi', 'tipe' => 'staffdept'],
            ['nama' => 'divisi', 'tipe' => 'staffdept'],
            ['nama' => 'Tenaga Pendidik/Dosen', 'tipe' => 'staffdept'],
            ['nama' => 'Tenaga Kependidikan', 'tipe' => 'staffdept'],

            //artikel
            ['nama' => 'Prestasi', 'tipe' => 'artikel'],
            ['nama' => 'Berita', 'tipe' => 'artikel'],
            ['nama' => 'Akademik', 'tipe' => 'artikel'],
            ['nama' => 'Karir', 'tipe' => 'artikel'],
            ['nama' => 'SDGS', 'tipe' => 'artikel'],
        ]);     
    }
}
