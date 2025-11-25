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
                'tanggal_lahir'    => '2004-01-16',
                'angkatan'         => '2022',
                'status'           => 'aktif',
                'username'         => 'muzaqibagas',
                'email'            => 'mahasiswa@example.com',
                'email_verified_at'=> now(), // juga diverifikasi agar langsung bisa login
                'password'         => Hash::make('bagas123'),
                'jenis_kelamin'    => 'Laki-laki',
                'role'             => 'Mahasiswa',
                'foto'             => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_jenjang'       => 3, // sesuaikan dengan id yang ada di tabel `jenjangs`
                'nim'              => 'J0403221043',
                'nama'             => 'Hasna Nabiilah Widiani',
                'no_hp'            => '081234567890',
                'alamat'           => 'Jl. Mahasiswa No.2',
                'tanggal_lahir'    => '2003-08-19',
                'angkatan'         => '2022',
                'status'           => 'aktif',
                'username'         => 'hasnabiilah',
                'email'            => 'mahasiswi@example.com',
                'email_verified_at'=> now(), // juga diverifikasi agar langsung bisa login
                'password'         => Hash::make('hasna123'),
                'jenis_kelamin'    => 'Perempuan',
                'role'             => 'Mahasiswa',
                'foto'             => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);

        for ($i = 1; $i <= 50; $i++) {
            DB::table('users')->insert([
                'id_jenjang'       => 3,
                'nim'              => 'DUMMY' . str_pad($i, 3, '0', STR_PAD_LEFT), // aman, tidak bentrok
                'nama'             => "Mahasiswa $i",
                'no_hp'            => '08120000' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'alamat'           => "Jl. Dummy No.$i",
                'tanggal_lahir'    => '2003-01-01',
                'angkatan'         => '2022',
                'status'           => 'aktif',
                'username'         => "mhs$i",
                'email'            => "mhs$i@example.com",
                'email_verified_at'=> now(),
                'password'         => Hash::make('password'),
                'jenis_kelamin'    => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'role'             => 'Mahasiswa',
                'foto'             => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}