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
        // Ambil user admin
        $admin = User::where('role', 'Admin')->first();

        if (!$admin) {
            return; // hentikan jika tidak ada admin
        }

        // 12 data Ketua DHHS
        $dataKetua = [
            ['nama' => 'Dr. Budi Santoso',     'foto' => 'uploads/ketua/1.jpg',  'tahun_mulai' => 2010, 'tahun_selesai' => 2012],
            ['nama' => 'Prof. Rina Wardani',   'foto' => 'uploads/ketua/2.jpg',  'tahun_mulai' => 2012, 'tahun_selesai' => 2014],
            ['nama' => 'Ir. Andi Pratama',     'foto' => 'uploads/ketua/3.jpg',  'tahun_mulai' => 2014, 'tahun_selesai' => 2016],
            ['nama' => 'Dr. Ferry Nugroho',    'foto' => 'uploads/ketua/4.jpg',  'tahun_mulai' => 2016, 'tahun_selesai' => 2017],
            ['nama' => 'Dr. Siti Aminah',      'foto' => 'uploads/ketua/5.jpg',  'tahun_mulai' => 2017, 'tahun_selesai' => 2018],
            ['nama' => 'Dr. Dwi Yulianto',     'foto' => 'uploads/ketua/6.jpg',  'tahun_mulai' => 2018, 'tahun_selesai' => 2019],
            ['nama' => 'Prof. Lestari Widya',  'foto' => 'uploads/ketua/7.jpg',  'tahun_mulai' => 2019, 'tahun_selesai' => 2020],
            ['nama' => 'Dr. Rachmat Setiawan', 'foto' => 'uploads/ketua/8.jpg',  'tahun_mulai' => 2020, 'tahun_selesai' => 2021],
            ['nama' => 'Dr. Tri Handoko',      'foto' => 'uploads/ketua/9.jpg',  'tahun_mulai' => 2021, 'tahun_selesai' => 2022],
            ['nama' => 'Prof. Mira Azzahra',   'foto' => 'uploads/ketua/10.jpg', 'tahun_mulai' => 2022, 'tahun_selesai' => 2023],
            ['nama' => 'Dr. Sutanto Wijaya',   'foto' => 'uploads/ketua/11.jpg', 'tahun_mulai' => 2023, 'tahun_selesai' => 2024],
            ['nama' => 'Prof. Joko Prabowo',   'foto' => 'uploads/ketua/12.jpg', 'tahun_mulai' => 2024, 'tahun_selesai' => 2025],
        ];

        // Insert menggunakan updateOrInsert agar tidak duplikat
        foreach ($dataKetua as $ketua) {
            DB::table('ketua_dhhs')->updateOrInsert(
                ['nama' => $ketua['nama']], // cek berdasarkan nama
                [
                    'id_user' => $admin->id,
                    'foto' => $ketua['foto'],
                    'tahun_mulai' => $ketua['tahun_mulai'],
                    'tahun_selesai' => $ketua['tahun_selesai'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
