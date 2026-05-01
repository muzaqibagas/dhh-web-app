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
            // dosen        
            // [
            //     'id_jenjang'       => null,
            //     'nim'              => 'J0123',
            //     'nama'             => 'Dr. Mahdi Mubarok, S.Si., M.Si',
            //     'no_hp'            => '0123456789',
            //     'alamat'           => 'Jl. dosen  No. 1',
            //     'tanggal_lahir'    => '2000-01-01',
            //     'angkatan'         => null,
            //     'status'           => 'aktif',
            //     'username'         => 'dosen',
            //     'email'            => 'dosen@example.com',
            //     'email_verified_at'=> now(), // sudah diverifikasi agar bisa login langsung
            //     'password'         => Hash::make('dosen123')
            //     'jenis_kelamin'    => 'Laki-laki',
            //     'role'             => 'Dosen',
            //     'foto'             => null,
            //     'created_at'       => now(),
            //     'updated_at'       => now(),
            // ],
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
                'username'         => 'Hasilhutan',
                'email'            => 'dhht@apps.ipb.ac.id',
                'email_verified_at'=> now(), // sudah diverifikasi agar bisa login langsung
                'password'         => Hash::make('Hasilhutan1P8'),
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
    }
}