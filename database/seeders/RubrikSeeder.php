<?php

namespace Database\Seeders;

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

            //kolokium
            [
                'nama_kriteria' => 'Proposal Kolokium',
                'bobot' => 50,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Teknik Penyajian Materi',
                'bobot' => 30,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Kemampuan Menjawab Pertanyaan',
                'bobot' => 20,
                'jenis_sidang' => 'kolokium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //seminar hasil
            [
                'nama_kriteria' => 'Penulisan Makalah',
                'bobot' => 40,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penguasaan Materi',
                'bobot' => 30,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Kemampuan Penyajian',
                'bobot' => 30,
                'jenis_sidang' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //komprehensif
            [
                'nama_kriteria' => 'Penulisan Tugas Akhir',
                'bobot' => 40,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Penguasaan Materi',
                'bobot' => 40,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kriteria' => 'Kemampuan Menjawab',
                'bobot' => 20,
                'jenis_sidang' => 'komprehensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
        ]);
    }
}
