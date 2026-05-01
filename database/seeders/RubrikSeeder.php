<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rubriks')->insert([
            [
                'nama_kriteria' => 'Efektifitas dan Kejelasan (cara penyajian presentasi)',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Sistematika Penyajian (materi presentasi)',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penampilan dan Sikap',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Latar Belakang dan Perumusan Masalah',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Kemampuan dasar terkait & Landasan Teori.',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Metoda Penelitian & Penguasaan Hasil penelitian',
                'bobot' => 20,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penulisan sesuai dengan kaidah ilmiah',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penulisan Latar Belakang & Perumusan Masalah',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Engagement (Keselarasan Antar Kalimat, Antar Paragraf dan Antar Bab)',
                'bobot' => 10,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Efektifitas dan Kejelasan (cara penyajian presentasi)',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Sistematika Penyajian (materi presentasi)',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penampilan dan Sikap',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Latar Belakang dan Perumusan Masalah',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Kemampuan dasar terkait & Landasan Teori.',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Metoda Penelitian & Penguasaan Hasil penelitian',
                'bobot' => 20,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penulisan sesuai dengan kaidah ilmiah',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penulisan Latar Belakang & Perumusan Masalah',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Engagement (Keselarasan Antar Kalimat, Antar Paragraf dan Antar Bab)',
                'bobot' => 10,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penampilan dan Sikap',
                'bobot' => 10,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pengetahuan Dasar Terkait',
                'bobot' => 30,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Latar Belakang dan Perumusan Masalah Tugas Akhir',
                'bobot' => 10,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Pemahaman Metoda Penelitian & Penguasaan Pembahasan dan Hasil (termasuk Kesimpulan dan Saran)',
                'bobot' => 30,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penulisan sesuai dengan kaidah ilmiah',
                'bobot' => 10,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Engagement (Kesesuaian Antar Kalimat, Antar Paragraf dan Antar Bab)',
                'bobot' => 10,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
