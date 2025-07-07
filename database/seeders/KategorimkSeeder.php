<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategorimkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Kompetensi Umum'],
            ['nama' => 'Kompetensi Dasar Program Studi'],
            ['nama' => 'Kompetensi Program Studi'],
            ['nama' => 'Minat Program Studi'],
            ['nama' => 'Pengayaan'],
            ['nama' => 'Tugas Akhir'],
        ];

        DB::table('kategorimks')->insert($data);
    }
}
