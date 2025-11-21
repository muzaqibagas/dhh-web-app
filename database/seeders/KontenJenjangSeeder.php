<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontenJenjangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('konten_jenjangs')->insert([

            // ======================= S1 =======================
            [
                'id_jenjang' => 1, // S1
                'profil' => "Program Studi Teknologi Hasil Hutan merupakan salah satu program studi yang ada di Departemen Hasil Hutan Fakultas Kehutanan dan Lingkungan IPB. Program Studi Teknologi Hasil Hutan memperoleh akreditasi A berdasarkan keputusan dari Badan Akreditasi Nasional - Perguruan Tinggi (BAN-PT) No. 0140/SK/BAN-PT/Akred/S/I/2017 tanggal 10 Januari 2017 dan berlaku sampai tanggal 10 Januari 2022.",
                'visi' => "Mengacu pada Visi jangka panjang IPB sebagaimana tertuang dalam Dalam Statuta IPB Pasal 2 (1) PP 66/2013, yaitu menjadi terdepan dalam memperkokoh martabat bangsa melalui pendidikan tinggi unggul pada tingkat global di bidang pertanian, kelautan, dan biosains tropika dan Visi antara IPB seperti yang tercantum dalam dokumen Rencana Strategis IPB Tahun 2014-2018, yaitu menjadi Perguruan Tinggi Berbasis Riset, Bertaraf Internasional, dan penggerak Prima Pengarusutamaan Pertanian serta Visi FAHUTAN-IPB, maka Visi Departemen Hasil Hutan dalam rangka mewujudkan kondisi yang diinginkan untuk kurun waktu 10 (sepuluh) tahun mendatang adalah: “Menjadi lembaga pendidikan tinggi bertaraf internasional dalam menghasilkan SDM bermutu dan mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan berdasarkan falsafah dan tujuan Pancasila”. ",
                'misi' => "Dalam rangka mewujudkan visinya, Departemen Hasil Hutan menetapkan misi untuk kurun waktu 5 tahun mendatang sebagai berikut: 1. Menyelenggarakan pendidikan tinggi bermutu yang berbasis penelitian (research based) dan pembinaan kemahasiswaan yang komprehensif menuju world class institution. 2. Mengembangkan IPTEKS pemanfaatan hasil hutan dan melakukan layanan masyarakat yang mengedepankan inovasi IPTEKS yang bermanfaat bagi masyarakat dalam pembangunan industri pemanfaatan hasil hutan secara efisien, adil dan berkelanjutan. 3. Mengembangkan departemen melalui manajemen perguruan tinggi yang berorientasi pada mutu, profesionalisme, dan keterbukaan. 4. Menghasilkan lulusan yang menjunjung tinggi kebenaran dan kejujuran, memiliki sikap dan perilaku yang responsif, kooperatif dan kreatif sehingga memiliki keunggulan kompetitif dan integritas. Berdasarkan misi DHHT diatas, maka misi PS THH adalah menyelenggarakan program tri dharma untuk menghasilkan sumberdaya manusia berkualifikasi sarjana dengan kompetensi utama teknologi hasil hutan bertaraf internasional dan mampu mengembangkan inovasi IPTEKS untuk berkontribusi terhadap peningkatan produktifitas dan efisiensi industri hasil hutan.",
                'tujuanpendidikan' => null,
                'kompetensilulusan' => "Kompetensi lulusan PS THH adalah mempunyai Dasar Ketrampilan, Kemampuan Analisis dan Sintesis yang andal, serta Profesionalisme dan Kemandirian yang kuat pada bidang ilmu dan teknologi hasil hutan serta berjiwa kewirausahaan. Kompetensi tersebut dijabarkan dalam 4 bagian, yaitu:

1. Kompetensi Bagian Peningkatan Kualitas Kayu (anatomi kayu, sifat-sifat kayu, kualitas kayu, pengendalian rayap, dan pengeringan kayu)
2. Kompetensi Bagian Biokomposit (teknologi biokomposit, teknologi perekatan kayu, dan analisis kuantitatif dan ekonomi hutan)
3. Kompetensi bagian Rekayasa dan Desain Bangunan Kayu (keteknikan kayu, sifat fisik dan mekanisme  kayu, uji destruktif kayu, dan proteksi bangunan kayu)
4. Kompetensi Bagian Kimia Hasil Hutan (kimia hasil hutan, teknologi pulp dan kertas, dan pengolahan hasil hutan non kayu)",
                'capaianpembelajaran' => "1. Menunjukkan sikap jujur, mandiri, humanis, berfikiran luas, beretika,motivasi tinggi sebagai pembelajar,dan bertanggung jawab atas pekerjaan di bidang keahliannya.
2. Mampu menerapkan pemikiran logis,kritis, sistematis, kreatif, inovatif, dan memiliki kemampuan berkomunikasi secara efektif dan bekerjasama dalam memecahkan masalah.
3. Menguasai konsep teoritis umum ilmu kehutanan (pengelolaan hutan lestari) yang mencakup pendirian, pelestarian, pemanenan, pemrosesan dan pemasaran.
4. Mampu menerapkan ilmu pengetahuan dan teknologi peningkatan kualitas hasil hutan melalui proses permesinan, pengeringan, pengawetan dan pemrosesan akhir yang didukung oleh sifat-sifat kayu dan ilmu struktur kayu.
5. Mampu menerapkan ilmu, teknologi, dan seni hasil hutan di bidang pemilihan bahan baku, proses pengujian dan persiapan produk biokomposit.
6. Mampu menerapkan ilmu pengetahuan dan teknologi hasil hutan berdasarkan prinsip-prinsip kimia untuk meningkatkan efisiensi pemanfaatan sumber daya.
7. Mampu menerapkan ilmu pengetahuan, teknologi, dan seni pemanfaatan hasil hutan di bidangkekuatan material, desain dan manajemen, analisis struktural, teknik kayu dan upaya perlindungan bangunan.
8. Mampu menerapkan ilmu pengetahuan, teknologi dan seni pemanfaatan hasil hutan di bidang manajemen produksi, pemasaran dan perdagangan produk hutan, dan efisiensi industri hasil hutan.
9. Mampu merancang dan melaksanakan penelitian dengan metodologi yang benar dan menganalisa serta menginterpretasikan data dengan tepat",
                'foto' => 'img/mhsdhh.png',
                'leaflet' => null,
                'sertifikatakreditasi' => 'img/akreditasis1.jpg',
                'deskripsiakreditasi' => "Program Studi Sarjana Teknologi Hasil Hutan Departemen Hasil Hutan Fakultas Kehutanan & Lingkungan IPB University telah terakreditasi A Berdasarkan Keputusan BAN-PT NOMOR : 13986/SK/BAN-PT/Ak-PPJ/S/XII/2021",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================= S2 =======================
            [
                'id_jenjang' => 2, // S2
                'profil' => "Berdasarkan pada Peraturan Pemerintah (PP) RI Nomor 154 tahun 2000 tentang penetapan IPB sebagai PT BHMN pada tahun 2006, maka IPB melalui SK Rektor Nomor 001/K13/PP/2005 tanggal 10 Januari 2005 tentang Penataan Departemen di Lingkungan IPB, telah menetapkan Departemen Hasil Hutan (DHH) sebagai organisasi pelaksana Program Studi S2 Ilmu dan Teknologi Hasil Hutan (PS THH) dengan sistem kurikulum Mayor-Minor yang mulai berlaku tahun ajaran 2007-2008",
                'visi' => "Visi Program Studi S2 Ilmu dan Teknologi Hasil Hutan adalah menjadi program studi yang unggul dalam pembelajaran, pengembangan ilmu pengetahuan serta inovasi teknologi dan seni pemanfaatan hasil hutan yang berkualitas, khususnya dalam mewujudkan pengembangan industri yang berbasis sumber daya hutan secara berkelanjutan.

Visi Program Studi S2 Ilmu dan Teknologi Hasil Hutan ini sejalan dengan visi jangka panjang dan jangka menengah IPB (Ketetapan Majelis Wali Amanat IPB Nomor: 30/MWA-IPB/2017 dan Nomor: 18/IT3.MWA/PR/2018), visi jangka panjang dan jangka menengah Fahutan dan visi jangka panjang dan jangka menengah Departemen Hasil Hutan. Visi IPB jangka menengah berdasarkan Dokumen Rencana Strategis IPB Tahun 2019-2023 adalah “Menjadi perguruan tinggi berbasis riset dan terdepan dalam inovasi untuk kemandirian bangsa menuju techno-socio enterpreneurial university yang unggul di tingkat global pada bidang pertanian, kelautan, biosains tropika”. Merujuk pada visi IPB jangka menengah ini, maka visi Fahutan IPB 2022-2026 adalah “menjadi fakultas kelas dunia dalam bidang kehutanan dan lingkungan tropika berkelanjutan”. Berdasarkan visi IPB dan visi Fahutan serta dalam rangka mewujudkan kondisi yang diinginkan untuk kurun waktu 5 (lima) tahun mendatang, maka visi Departemen Hasil Hutan (DHH) adalah: “Menjadi lembaga pendidikan tinggi berbasis riset dan bertaraf internasional dalam menghasilkan SDM bermutu dan mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan berdasarkan falsafah dan tujuan Pancasila”.",
                'misi' => "Menyelenggarakan kegiatan tridharma guna menghasilkan:

Sumberdaya manusia yang mempunyai kualifikasi S2 dengan kompetensi utama ilmu dan teknologi hasil hutan, menjunjung tinggi kebenaran dan kejujuran, serta memiliki sikap dan perilaku yang responsif, kooperatif dan kreatif sehingga memiliki keunggulan kompetitif dan integritas.
Inovasi teknologi khususnya di bidang pemanfaatan hasil hutan kayu dan non-kayu berbasis penelitian (research based) yang mampu memberikan kontribusi pada pembangunan industri pemanfaatan hasil hutan yang efisien dan berkelanjutan",
                'tujuanpendidikan' => null,
                'kompetensilulusan' => "1. Mampu mengembangkan pengetahuan, teknologi, dan atau seni di dalam bidang keilmuannya atau praktek profesionalnya melalui riset, hingga menghasilkan karya inovatif dan teruji
2. Mampu memecahkan permasalahan sains, teknologi, dan atau seni di dalam bidang keilmuannya melalui pendekatan inter atau multidisipliner
3. Mampu mengelola riset dan pengembangan yang bermanfaat bagi masyarakat dan keilmuan, serta mampu mendapat pengakuan nasional maupun internasional",
                'capaianpembelajaran' => "1. Menguasai pengetahuan dan kemampuan riset  dalam mengembangkan ilmu dan teknologi pemanfaatan biomasa  hutan berdasarkan  ilmu biomaterial, rekayasa proses, manajemen, dan   bisnis.
2. Mampu mengelola  dan mengembangkan riset  yang berkaitan dengan biomaterial   secara inter atau multi-disipliner.
3. Mampu mengelola dan mengembangkan  riset berkaitan dengan ilmu dan teknologi pemanfaatan biomasa  hutan serta mengomunikasikan hasilnya ke komunitas ilmiah dan umum baik pada tataran nasional maupun internasional.
4. Mampu membangun komitmen, integritas profesional dan nilai-nilai etika.",
                'foto' => 'img/mhsdhh.png',
                'leaflet' => null,
                'sertifikatakreditasi' => 'img/akreditasis2.jpg',
                'deskripsiakreditasi' => "Program Studi Magister Ilmu dan Teknologi Hasil Hutan Departemen Hasil Hutan Fakultas Kehutanan dan Lingkungan IPB University telah terakreditasi A Berdasarkan Keputusan BAN-PT Nomor : 8067/SK/BAN-PT/Ak.Ppj/M/X/2022",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================= S3 =======================
            [
                'id_jenjang' => 3, // S3
                'profil' => "Berdasarkan pada Peraturan Pemerintah (PP) RI Nomor 154 tahun 2000 tentang penetapan IPB sebagai PT BHMN pada tahun 2006, maka IPB melalui SK Rektor Nomor 027/K13/PP/2007 tanggal 22 Maret 2007 tentang Penataan Mayor Pada Program Pendidikan Pascasarjana Kurikulum Sistem Mayor Minor di Lingkungan IPB, telah menetapkan Departemen Hasil Hutan (DHH) sebagai organisasi pelaksana Program Studi S3 Rekayasa dan Peningkatan Mutu Hasil Hutan (S3 RPM) dengan sistem kurikulum Mayor-Minor yang mulai berlaku tahun ajaran 2007-2008",
                'visi' => "Visi Program Studi Doktor Ilmu dan Teknologi Hasil Hutan adalah menjadi program studi yang unggul dalam pengembangan ilmu pengetahuan, teknologi dan seni (IPTEKS) hasil hutan bermutu tinggi dan bertaraf internasional.

Visi PS Doktor ITHH ini sejalan dengan visi jangka panjang dan jangka menengah IPB (Ketetapan Majelis Wali Amanat IPB Nomor: 30/MWA-IPB/2017 dan Nomor: 18/IT3.MWA/PR/2018)), visi jangka panjang dan jangka menengah Fahutan dan visi jangka panjang dan jangka menengah Departemen Hasil Hutan. Visi IPB jangka menengah berdasarkan Dokumen Rencana Strategis IPB Tahun 2019-2023 adalah “Menjadi perguruan tinggi berbasis riset dan terdepan dalam inovasi untuk kemandirian bangsa menuju techno-socio enterpreneurial university yang unggul di tingkat global pada bidang pertanian, kelautan, biosains tropika”. Merujuk pada visi IPB jangka menengah ini, maka visi Fahutan IPB 2022-2026 adalah “menjadi fakultas kelas dunia dalam bidang kehutanan dan lingkungan tropika berkelanjutan”. Berdasarkan visi IPB dan visi Fakultas Kehutanan serta dalam rangka mewujudkan kondisi yang diinginkan untuk kurun waktu 5 (lima) tahun mendatang, maka visi Departemen Hasil Hutan (DHH) adalah: “Menjadi lembaga pendidikan tinggi berbasis riset dan bertaraf internasional dalam menghasilkan SDM bermutu dan mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan berdasarkan falsafah dan tujuan Pancasila”.",
                'misi' => "Menyelenggarakan kegiatan tridharma guna menghasilkan:

1. Sumberdaya manusia yang mempunyai kualifikasi doktor (S3) dengan kompetensi utama ilmu dan teknologi hasil hutan, menjunjung tinggi kebenaran dan kejujuran, serta memiliki sikap dan perilaku yang responsif, kooperatif dan kreatif sehingga memiliki keunggulan kompetitif dan integritas.
2. Inovasi teknologi khususnya di bidang pemanfaatan hasil hutan kayu dan non-kayu berbasis penelitian (research based) yang mampu memberikan kontribusi pada peningkatan mutu keilmuan dan teknologi hasil hutan serta pembangunan industri pemanfaatan hasil hutan yang efisien dan berkelanjutan.",
                'tujuanpendidikan' => "Menghasilkan lulusan yang mampu mengembangkan konsep ilmu pengetahuan, teknologi, dan seni (IPTEKS) baru serta mengelola, memimpin, dan mengembangkan program penelitian secara mandiri dalam bidang peningkatan mutu kayu, bio-komposit, kimia hasil hutan, rekayasa dan disain bangunan kayu dan industri hasil hutan",
                'kompetensilulusan' => "Mempunyai kemampuan pendekatan interdisipliner dalam berkarya di bidang peningkatan mutu kayu, bio-komposit, kimia hasil hutan, rekayasa dan disain bangunan kayu dan industri hasil hutan secara efisien dan efektif",
                'capaianpembelajaran' => "1. Mampu merencanakan, melaksanakan, dan mengevaluasi riset untuk pengembangan IPTEK di bidang ilmu pengetahuan  dan teknologi pemanfaatan biomasa  hutan  secara komprehensif mengenai  ilmu biomaterial,   rekayasa proses, manajemen, dan   bisnis untuk menghasilkan bioproduk yang memiliki kebaruan, inovatif, dan teruji. 
2. Mampu mengintegrasikan, menganalisis, mensintesis, menerapkan konsep,  fakta, dan teknik dalam memecahkan problem-problem baru dan kompleks yang berkaitan dengan biomaterial  melalui pendekatan inter, multi atau transdisipliner. 
3. Mampu mengelola, memimpin dalam perencanaan dan pelaksanaan riset serta mengembangkan  peta jalan riset dalam bidang pemanfaatan biomasa  hutan,  serta mampu mengkomunikasikan hasilnya ke komunitas ilmiah dan umum baik pada tataran nasional dan internasional.
4. Mampu membangun komitmen, integritas profesional dan nilai-nilai etika.",
                'foto' => 'img/mhsdhh.png',
                'leaflet' => null,
                'sertifikatakreditasi' => 'img/akreditasis3.jpg',
                'deskripsiakreditasi' => "Program Studi Doktor Ilmu dan Teknologi Hasil Hutan Departemen Hasil Hutan Fakultas Kehutanan dan Lingkungan IPB University telah terakreditasi A Berdasarkan Keputusan BAN-PT NOMOR : 10398/SK/BAN-PT/Ak.Ppj/D/XII/2022",
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
