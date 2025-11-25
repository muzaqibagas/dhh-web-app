<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KetuaDHHSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {               
     
        DB::table('ketua_dhhs')->insert([
            ['id_user' => 1, 'nama' => 'Dr. Ir. Wasrin Syafii, M.Agr',     'foto' => 'foto_ketuadhh/wasrin.jpg',  'tahun_mulai' => 1993, 'tahun_selesai' => 2001],
            ['id_user' => 1, 'nama' => 'Dr. Ir. Naresworo Nugroho, M.S.',   'foto' => 'foto_ketuadhh/nares.jpg',  'tahun_mulai' => 2001, 'tahun_selesai' => 2003],
            ['id_user' => 1, 'nama' => 'Dr. Ir. Dede Hermawan, MSc.F.Trop',     'foto' => 'foto_ketuadhh/dede.jpg',  'tahun_mulai' => 2003, 'tahun_selesai' => 2009],
            ['id_user' => 1, 'nama' => 'Dr. Ir. I Wayan Darmawan, MSc',    'foto' => 'foto_ketuadhh/wayan.png',  'tahun_mulai' => 2009, 'tahun_selesai' => 2013],            
            ['id_user' => 1, 'nama' => 'Prof.Dr. Ir. Fauzi Febrianto, M.S.',   'foto' => 'foto_ketuadhh/fauzi.jpg', 'tahun_mulai' => 2014, 'tahun_selesai' => 2018],
            ['id_user' => 1, 'nama' => 'Prof.Dr. Ir. Deded Sarip Nawawi, M.Sc.F.Trop',   'foto' => 'foto_ketuadhh/deded.jpg', 'tahun_mulai' => 2018, 'tahun_selesai' => 2023],
            ['id_user' => 1, 'nama' => 'Dr. Ir. Sekartining Rahayu, S.Hut., M.Si.,',   'foto' => 'foto_ketuadhh/istie.jpg', 'tahun_mulai' => 2023, 'tahun_selesai' => 2028],            
        ]);    
    }
}
