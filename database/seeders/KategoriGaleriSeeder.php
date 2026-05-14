<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_galeris')->insert([
            ['nama' => 'Dosen '],
            ['nama' => 'Mahasiswa'],
        ]);
    }
}
