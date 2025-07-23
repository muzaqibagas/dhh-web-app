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
        // Ambil semua tipe dari tabel 'tipes' dalam bentuk ['nama' => id]
        $tipes = DB::table('tipes')->pluck('id', 'nama');

        // Masukkan data kategoris berdasarkan id_tipe
        DB::table('kategoris')->insert([
            // matakuliah
            ['nama' => 'Kompetensi Umum', 'id_tipe' => $tipes['matakuliah']],
            ['nama' => 'Kompetensi Dasar Program Studi', 'id_tipe' => $tipes['matakuliah']],
            ['nama' => 'Kompetensi Program Studi', 'id_tipe' => $tipes['matakuliah']],
            ['nama' => 'Minat Program Studi', 'id_tipe' => $tipes['matakuliah']],
            ['nama' => 'Pengayaan', 'id_tipe' => $tipes['matakuliah']],
            ['nama' => 'Tugas Akhir', 'id_tipe' => $tipes['matakuliah']],

            // galeri
            ['nama' => 'Akademik', 'id_tipe' => $tipes['galeri']],
            ['nama' => 'Fasilitas', 'id_tipe' => $tipes['galeri']],
            ['nama' => 'Prestasi', 'id_tipe' => $tipes['galeri']],
            ['nama' => 'Kegiatan', 'id_tipe' => $tipes['galeri']],
            ['nama' => 'SDGS', 'id_tipe' => $tipes['galeri']],            

            // artikel
            ['nama' => 'Prestasi', 'id_tipe' => $tipes['artikel']],
            ['nama' => 'Berita', 'id_tipe' => $tipes['artikel']],
            ['nama' => 'Akademik', 'id_tipe' => $tipes['artikel']],
            ['nama' => 'Karir', 'id_tipe' => $tipes['artikel']],
            ['nama' => 'SDGS', 'id_tipe' => $tipes['artikel']],
        ]);    
    }
}
