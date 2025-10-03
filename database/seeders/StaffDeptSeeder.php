<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffDeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('staff_depts')->insert([
        //     [
        //         'id_kategoristaff' => 1,
        //         'id_divisi' => 1,
        //         'foto' => null,
        //         'nama' => 'Prof.Dr.Ir. I Wayan Darmawan, M.Sc.F.Trop',
        //         'tanggal_lahir' => '1966-02-12',
        //         'nip' => '196602121991031002',
        //         'jabatan' => 'Guru Besar',
        //         'email' => 'w_darmawan@apps.ipb.ac.id',
        //         'keahlian' => 'Ilmu Teknologi Kayu',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id_kategoristaff' => 1,
        //         'id_divisi' => 1,
        //         'foto' => null,
        //         'nama' => 'Prof. Dr. Ir. Deded Sarip Nawawi, M.Sc.F.Trop',
        //         'tanggal_lahir' => '1966-01-13',
        //         'nip' => '196601131991031001',
        //         'jabatan' => 'Guru Besar',
        //         'email' => 'dsnawawi@apps.ipb.ac.id',
        //         'keahlian' => 'Kimia Kayu',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id_kategoristaff' => 1,
        //         'id_divisi' => 1,
        //         'foto' => null,
        //         'nama' => 'Prof. Dr.Ir. I Ny. Jaya Wistara, MS',
        //         'tanggal_lahir' => '1963-12-31',
        //         'nip' => '196312311989031027',
        //         'jabatan' => 'Guru Besar',
        //         'email' => 'nwistara@apps.ipb.ac.id',
        //         'keahlian' => 'Kimia Hasil Hutan',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id_kategoristaff' => 1,
        //         'id_divisi' => 1,
        //         'foto' => null,
        //         'nama' => 'Prof.Dr.Ir. Imam Wahyudi, MS',
        //         'tanggal_lahir' => '1963-01-06',
        //         'nip' => '196301061987031004',
        //         'jabatan' => 'Guru Besar',
        //         'email' => 'imamwa@apps.ipb.ac.id',
        //         'keahlian' => 'Anatomi Kayu',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id_kategoristaff' => 1,
        //         'id_divisi' => 1,
        //         'foto' => null,
        //         'nama' => 'Prof.Dr.Ir. Dede Hermawan, M.Sc.F.Trop',
        //         'tanggal_lahir' => '1963-07-11',
        //         'nip' => '196307111991031002',
        //         'jabatan' => 'Guru Besar',
        //         'email' => 'dedehe@apps.ipb.ac.id',
        //         'keahlian' => 'Biokomposit',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
