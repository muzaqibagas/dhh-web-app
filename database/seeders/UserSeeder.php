<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'id_jenjang' => null,
                'nim' => 'Admin1',
                'nama' => 'Admin',
                'no_hp' => '081380716742',
                'alamat' => 'Jl. Admin Pusat',
                'tanggal_lahir' => '2004-01-16',
                'angkatan' => null,
                'status' => 'aktif',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'jenis_kelamin' => 'Laki-laki',
                'role' => 'Admin',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Mahasiswa
            [
                'id_jenjang' => 3,
                'nim' => 'J0403221096',
                'nama' => 'Muzaqi Bagas',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Mahasiswa No.1',
                'tanggal_lahir' => '2003-05-20',
                'angkatan' => '2022',
                'status' => 'aktif',
                'username' => 'muzaqibagas',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('mahasiswa123'),
                'jenis_kelamin' => 'Perempuan',
                'role' => 'Mahasiswa',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
