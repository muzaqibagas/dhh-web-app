<?php

namespace Database\Seeders;

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
                'id_jenjang'       => null,
                'nim'              => 'ADMIN01',
                'nama'             => 'Admin Sistem',
                'no_hp'            => '081380716742',
                'alamat'           => 'Jl. Admin Pusat No. 1',
                'tanggal_lahir'    => '2000-01-01',
                'angkatan'         => null,
                'status'           => 'aktif',
                'username'         => 'admin',
                'email'            => 'admin@example.com',
                'email_verified_at'=> now(), // sudah diverifikasi agar bisa login langsung
                'password'         => Hash::make('admin123'),
                'jenis_kelamin'    => 'Laki-laki',
                'role'             => 'Admin',
                'foto'             => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],

            // Mahasiswa
            [
                'id_jenjang'       => 3, // sesuaikan dengan id yang ada di tabel `jenjangs`
                'nim'              => 'J0403221096',
                'nama'             => 'Anggito Rangkuti Bagas Muzaqi',
                'no_hp'            => '081234567890',
                'alamat'           => 'Jl. Mahasiswa No.1',
                'tanggal_lahir'    => '2003-05-20',
                'angkatan'         => '2022',
                'status'           => 'aktif',
                'username'         => 'muzaqibagas',
                'email'            => 'mahasiswa@example.com',
                'email_verified_at'=> now(), // juga diverifikasi agar langsung bisa login
                'password'         => Hash::make('mahasiswa123'),
                'jenis_kelamin'    => 'Perempuan',
                'role'             => 'Mahasiswa',
                'foto'             => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}