<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SdgsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sdgs')->insert([
            [
                'nama_sdgs' => 'SDGS Goals 1',
                'foto' => 'img/SDGS1.jpg',
                'deskripsi' => 'Mengakhiri kemiskinan dalam segala bentuk dan memberdayakan kelompok rentan untuk mencapai kehidupan yang lebih layak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 2',
                'foto' => 'img/SDGS2.jpg',
                'deskripsi' => 'Menghilangkan kelaparan melalui ketahanan pangan, perbaikan gizi, dan pertanian berkelanjutan agar semua orang mendapat makanan sehat dan cukup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 3',
                'foto' => 'img/SDGS3.jpg',
                'deskripsi' => 'Meningkatkan kesehatan masyarakat dengan memperkuat layanan kesehatan, menurunkan angka kematian, dan memperluas akses kesehatan yang terjangkau.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 4',
                'foto' => 'img/SDGS4.jpg',
                'deskripsi' => 'Memberikan pendidikan inklusif, adil, dan berkualitas melalui peningkatan mutu pembelajaran dan kesempatan belajar sepanjang hayat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 5',
                'foto' => 'img/SDGS5.jpg',
                'deskripsi' => 'Menghapus diskriminasi dan kekerasan berbasis gender, serta memastikan perempuan berpartisipasi penuh dalam pendidikan, pekerjaan, dan pengambilan keputusan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 6',
                'foto' => 'img/SDGS6.png',
                'deskripsi' => 'Menjamin akses air bersih dan sanitasi layak melalui pengelolaan air berkelanjutan dan lingkungan yang lebih sehat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 7',
                'foto' => 'img/SDGS7.jpg',
                'deskripsi' => 'Menyediakan energi yang terjangkau dan berkelanjutan dengan mempromosikan energi terbarukan serta efisiensi energi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 8',
                'foto' => 'img/SDGS8.jpg',
                'deskripsi' => 'Mendorong pertumbuhan ekonomi inklusif dan menyediakan pekerjaan layak yang aman serta adil bagi semua orang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 9',
                'foto' => 'img/SDGS9.jpg',
                'deskripsi' => 'Membangun infrastruktur kuat, mendukung industrialisasi berkelanjutan, dan memacu inovasi hingga tahun 2030.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 10',
                'foto' => 'img/SDGS10.jpg',
                'deskripsi' => 'Mengurangi kesenjangan dalam dan antarnegara dengan memperkuat inklusivitas serta mendukung kelompok rentan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 11',
                'foto' => 'img/SDGS11.jpg',
                'deskripsi' => 'Mewujudkan kota yang aman, inklusif, dan berkelanjutan melalui perencanaan yang baik, transportasi umum, dan pelestarian budaya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 12',
                'foto' => 'img/SDGS12.jpg',
                'deskripsi' => 'Mendorong konsumsi dan produksi berkelanjutan melalui efisiensi sumber daya, pengelolaan limbah, dan produk ramah lingkungan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 13',
                'foto' => 'img/SDGS13.jpg',
                'deskripsi' => 'Mengambil tindakan terhadap perubahan iklim dengan mengurangi emisi, melakukan adaptasi, dan mitigasi bencana.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 14',
                'foto' => 'img/SDGS14.jpg',
                'deskripsi' => 'Melindungi ekosistem laut melalui pengurangan limbah plastik, pengelolaan sumber daya maritim, dan pencegahan praktik perikanan merugikan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 15',
                'foto' => 'img/SDGS15.jpg',
                'deskripsi' => 'Melestarikan ekosistem darat dengan mengelola hutan, menjaga biodiversitas, dan meningkatkan konservasi hayati.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 16',
                'foto' => 'img/SDGS16.jpg',
                'deskripsi' => 'Membangun masyarakat damai, memperkuat akses keadilan, dan menciptakan lembaga yang efektif dan akuntabel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sdgs' => 'SDGS Goals 17',
                'foto' => 'img/SDGS17.jpg',
                'deskripsi' => 'Menguatkan kolaborasi global melalui kemitraan, transfer teknologi, dan dukungan keuangan untuk keberlanjutan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
