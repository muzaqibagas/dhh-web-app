<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontenDeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('konten_depts')->insert([
            'sejarah' => 'Departemen Hasil Hutan (DHH) yang sebelumnya bernama Departemen Teknologi Hasil Hutan berdiri pada tahun 1969. DHH adalah Departemen Hasil Hutan tertua di Indonesia dan memiliki fokus pada pengembangan bidang keilmuan dan teknologi hasil hutan yang mencakup kimia hasil hutan, biokomposit, teknologi peningkatan kualitas kayu, dan desain dan keteknikan struktur kayu.',

            'visi' => 'Menjadi lembaga pendidikan tinggi bertaraf internasional dalam menghasilkan SDM bermutu dan mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan.',

            'misi' => 'Menyelenggarakan program tri dharma untuk menghasilkan sumberdaya manusia berkualifikasi sarjana dengan kompetensi utama teknologi hasil hutan dan mengembangkan inovasi IPTEKS untuk berkontribusi terhadap peningkatan produktifitas dan efisiensi industri hasil hutan.',

            'tujuan' => '1. Mengoptimalkan pengembangan kapasitas sumberdaya melalui kerjasama di bidang pendidikan, penelitian, dan publikasi ilmiah terakreditasi baik nasional maupun internasional.
2. Mengoptimalkan pemberdayaan IPTEKS pemanfaatan hasil hutan melalui pengajaran, penelitian, publikasi, serta pelayanan pada masyarakat, yang dapat meningkatkan mutu departemen.
3. Mewujudkan manajemen pengelolaan sumberdaya departemen yang bermutu, profesional dan terbuka dalam pelaksanaan Tri Dharma Perguruan Tinggi yang bermanfaat bagi kesejahteraan di lingkungan DHHT dan masyarakat.
4. Menghasilkan lulusan PS THH yang mempunyai dasar keterampilan, kemampuan analisis dan sintesis yang andal, serta profesionalisme dan kemandirian yang kuat pada bidang ilmu dan teknologi hasil hutan, dan berjiwa kewirausahaan.',

            'kebijakanmutu' => 'Untuk mendukung pengembangan IPB sebagai perguruan tinggi yang memiliki daya saing tinggi dan berkompetisi secara sehat dengan perguruan tinggi lainnya di dunia untuk menjadi perguruan tinggi berskala internasional, kebijakan mutu DHHT mengacu pada kebijakan mutu Fakultas Kehutanan, yaitu:

1. Berpedoman pada aturan yang berlaku,
2. Memonitor penerapan sistem manajemen mutu serta memperbaiki sistem dan pendidikan secara berkesinambungan,
3. Melaksanakan internasionalisasi standar mutu penyelenggaraan akademik dan riset,
4. Meningkatkan kualitas input dan proses serta non akademik,
5. Meningkatkan jumlah publikasi, sitasi, dan teknologi aplikasi,
6. Tertib dan akuntable dalam penyelenggaraan pendidikan dan pengajaran,
7. Meyediakan dan melaksanakan kegiatan pemeliharaan sarana dan prasarana yang memadai, serta mengkomuinikasikan kebijakan mutu kepada para pengajar, pegawai, dan mahasiswa.
8. DHHT menggunakan dasar pengelolaan organisasi menggunakan prinsip manajemen yang dapat dipertanggungjawabkan, transparan, dan diakui pada tingkat nasional maupun internasional. Salah satunya adalah mengadopsi standar sistem manajemen mutu ISO 9001.

Pelaksanaan penjaminan mutu di DHHT dilakukan oleh Gugus Kendali Mutu (GKM) yang dikoordinasikan oleh Sekretaris Departemen dengan anggota komisi pendidikan dan staf pengajar yang ditunjuk, serta KTU Departemen.

Tugas GKM adalah membantu Ketua Departemen dalam hal:
1. Melakukan monitoring terhadap pelaksanaan seluruh kegiatan akademik dan non akademik sesuai dengan prosedur, ketentuan, perjanjian dan peraturan perundang-undangan yang berlaku
2. Melakukan monitoring pelaksanaan seluruh kegiatan akademik dan non akademik agar dapat memenuhi standar mutu dan sasaran mutu yang telah ditetapkan
3. Melakukan evaluasi bersama Ketua Departemen untuk tindakan korektif yang lebih dini terhadap pelaksanaan seluruh aktivitas penyelenggaraan akademik dan non akademik dilingkup kerjanya
4. Pengkoordinasian pembuatan laporan evaluasi diri mengikuti standar-standar dan parameter yang telah ditentukan.

GKM dibentuk melalui SK Dekan. Dalam implementasi sistem penjamin mutu, Kantor Manajemen Mutu (KMM), Gusus Penjamin Mutu (GPM), dan GKM berkoordinasi untuk mencapai sasaran mutu yang ditetapkan.',

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
