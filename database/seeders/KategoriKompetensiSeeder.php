<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('kategori_kompetensis')->insert([
            ['nama' => 'Kompetensi Mayor'],
            ['nama' => 'Kompetensi Minor'],                     
        ]); 
    }
}
