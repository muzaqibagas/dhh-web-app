<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoristaffs = [
            'Tenaga Pendidik/Dosen',
            'Tenaga Kependidikan',
            'Struktur Organisasi',            
        ];

        foreach ($kategoristaffs as $kategori) {
            DB::table('kategori_staffs')->insert([
                'nama' => $kategori,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
