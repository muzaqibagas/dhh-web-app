<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            ['nama' => 'Guru Besar'],
            ['nama' => 'Dosen'],
            ['nama' => 'Tendik'],
            ['nama' => 'Ketua Program Studi'],
            ['nama' => 'Kepala Laboratorium'],
            ['nama' => 'Staf Administrasi'],
        ]);
    }
}
