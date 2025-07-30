<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurikulumDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('kurikulum_details')->insert([
            [
                'id_jenjang' => 3,
                'id_kategorikompetensi' => 1, // Mayor
                'deskripsi' => 'Menghasilkan lulusan yang menguasai ilmu, teknologi, manajemen, dan ekonomi serta lingkungan dalam penyediaan bahan baku dan proses industri pengolahan dan pemanfaatan hasil hutan untuk mampu melaksanakan pengelolaan sumberdaya hutan berkelanjutan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenjang' => 3,
                'id_kategori_kompetensi' => 2, // Minor
                'deskripsi' => 'Peningkatan Mutu Hasil Hutan Mahasiswa mampu menjelaskan tentang identifikasi kayu, sifat fisis kayu dan upaya peningkatan mutu kayu melalui teknologi pengeringan, pengerjaan dan pengawetan kayu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenjang' => 3,
                'id_kategori_kompetensi' => 2,
                'deskripsi' => 'Industri Hasil Hutan Mahasiswa mampu menjelaskan tentang sifat kimia hasil hutan untuk pengembangan industri pulp dan kertas maupun industri berbasis serat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenjang' => 3,
                'id_kategori_kompetensi' => 2,
                'deskripsi' => 'Rekayasa Kayu Mahasiswa mampu menjelaskan tentang teknologi kayu lapis dan kayu lamina, sifat mekanis kayu sebagai bahan konstruksi, dan dapat menerapkan azas rekayasa kayu pada struktur bangunan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
