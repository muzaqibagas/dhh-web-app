<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisis')->insert([
            ['nama' => 'Biokomposit'],
            ['nama' => 'biorefinery Hasil Hutan'],
            ['nama' => 'Manajemen Industri Hasil Hutan'],
            ['nama' => 'Rekayasa dan Desain Bangunan Kayu'],
            ['nama' => 'Teknologi Peningkatan Mutu Kayu'],            
        ]); 
    }
}
