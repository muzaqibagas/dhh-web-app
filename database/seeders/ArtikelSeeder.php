<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('artikels')->insert([

            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel1.png',
                'judul' => 'Dosen Departemen Hasil Hutan di OSAKA Expo 2025, Jepang',
                'tanggal' => now(),
                'deskripsi' => 'Dalam rangka menindaklanjuti kerja sama antara pihak Indonesia dan Jepang dalam pembangunan rumah kayu di Kampus IPB Dramaga Bogor, sejumlah dosen Departemen Hasil Hutan (DHH), Fakultas Kehutanan dan Lingkungan, IPB University melakukan kunjungan ke Jepang pada 29 September hingga 4 Oktober 2025. Kegiatan ini merupakan bagian dari kolaborasi antara DHH IPB University, Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan Institut Teknologi Bandung (ITB), serta PT Iida Group Holdings dan University of Tokyo.

Salah satu agenda penting dalam lawatan tersebut adalah kunjungan ke OSAKA Expo 2025, yang difasilitasi oleh PT Iida Group Holdings (IGHD). Perusahaan ini menjadi salah satu peserta pameran yang menampilkan inovasi unggul dalam teknologi dan desain konstruksi kayu. PT IGHD sendiri telah menorehkan prestasi dengan meraih dua rekor dunia Guinness World Records, yaitu sebagai The Largest Roof in the Shape of a Fan dengan luas mencapai 218,4 m², serta The Largest Building Wrapped in Jacquard Fabric dengan luas 3.027,75 m².

Tim DHH yang terdiri atas Prof. Naresworo Nugroho, Dr. Istie S. Rahayu, Prof. Imam Wahyudi, Prof. Lina Karlinasari, dan Dr. Arinana diterima secara resmi oleh Mr. Atsushi Hirokawa, selaku Director of Joint Pavilion Iida Group x Osaka Metropolitan University. Kunjungan ke OSAKA Expo dilaksanakan pada Kamis, 2 Oktober 2025.



Dalam kunjungan tersebut, tim DHH berkesempatan mengunjungi beberapa paviliun, antara lain Paviliun Jerman, PT IGHD, dan Paviliun Italia. Selain itu, rombongan juga diajak melihat Wood Ring, struktur arsitektur kayu terbesar di dunia yang menjadi ikon utama OSAKA Expo dengan total luas mencapai 61.035,55 m². Bangunan megah ini juga meraih penghargaan Guinness World Records sebagai The Largest Wooden Architectural Structure.

Paviliun Jerman mengusung tema “Wa! Germany”, yang menonjolkan konsep Circular Economy. Kata “Wa” dalam bahasa Jepang memiliki tiga makna, yakni “Wa ?” (circle) yang melambangkan sirkulasi, “Wa ?” (harmony) yang berarti keharmonisan, serta “Wa ?” (wow) yang menggambarkan kekaguman.

Sementara itu, Paviliun PT IGHD menampilkan tema “Living Tomorrow: Smart, Sustainable, Connected”, yang menghadirkan model hunian cerdas ramah lingkungan dengan integrasi energi terbarukan, kecerdasan buatan (AI), serta konsep desain modular.

Adapun Paviliun Italia hadir dengan tema “Arts Regenerates Life”, menampilkan karya seni ikonik seperti Farnese Atlas di pusat galeri, serta mahakarya seniman terkenal seperti Tintoretto dan Caravaggio.

Kunjungan ini diharapkan dapat memperkaya wawasan dan memperluas jejaring kerja sama internasional, khususnya dalam bidang teknologi dan inovasi material berbasis kayu, yang relevan dengan pengembangan industri hasil hutan di Indonesia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 2,
                'id_sdgs' => 1,
                'foto' => 'img/artikel2.png',
                'judul' => 'Mahasiswa Pascasarjana ITHH Ikuti Kuliah Umum Bersama Dosen Universite de Lorraine, Perancis',
                'tanggal' => now(),
                'deskripsi' => 'Program Studi Ilmu dan Teknologi Hasil Hutan (ITHH), Departemen Hasil Hutan IPB University, kembali menghadirkan kegiatan akademik berskala internasional melalui kuliah umum yang disampaikan oleh dua profesor dari Universite de Lorraine, Perancis. Kegiatan ini dilaksanakan pada Rabu, 29 Oktober 2025, dan dihadiri oleh mahasiswa pascasarjana (S2 dan S3), mitra industri, serta pimpinan departemen.

Kuliah umum ini dirancang untuk memperluas wawasan keilmuan mahasiswa, mempertemukan perkembangan teori dan aplikasi hasil penelitian dari dalam maupun luar negeri, serta mengenalkan metodologi penelitian mutakhir di bidang teknologi hasil hutan. Selain itu, kegiatan ini menjadi ruang bagi mahasiswa untuk memunculkan ide-ide riset baru yang relevan dengan tantangan kehutanan dan industri berbasis kayu saat ini.

Kehadiran Prof. Philippe Gerardin dan Prof. Christine Gerardin tidak hanya untuk memberikan kuliah umum, tetapi juga sebagai bagian dari penguatan kerja sama akademik antara IPB University dan Universite de Lorraine. Kedua profesor tersebut merupakan penghubung utama program Doktor Double Degree antara kedua institusi. Pada tahun akademik 2025/2026, program ini telah menerima tiga orang mahasiswa yang merupakan dosen dari berbagai perguruan tinggi di Pulau Jawa dan Nusa Tenggara.



Kegiatan kuliah umum ini dihadiri oleh Ketua Departemen Hasil Hutan serta perwakilan mitra industri, yaitu PT Jaya Cemerlang Industri—Bapak Jimmy Candra (Direktur PT JCI), Bapak Ryan, dan Bapak Supardi. Secara keseluruhan, sekitar 30 mahasiswa pascasarjana turut berpartisipasi dalam kegiatan ini. Acara dipandu oleh Dr. Mahdi Mubarok sebagai moderator.

Pada sesi pemaparan materi, kedua narasumber menyampaikan topik penelitian yang sangat relevan dengan perkembangan teknologi hasil hutan dunia:

Prof. Philippe Gerardin: Non-Biocide Wood Treatments for Improvement of Quality of Fast-Growing Wood Species

Prof. Christine Gerardin: Valorisation of Plant Extractives for Wood Protection



Kuliah umum dosen luar negeri seperti ini memberikan manfaat yang jauh melampaui sesi tatap muka. Selain memperluas wawasan dan memperkuat pemahaman mahasiswa terhadap perkembangan ilmu pengetahuan global, kegiatan ini juga menjadi jembatan penting dalam membangun jejaring akademik internasional. Dampaknya tidak hanya dirasakan oleh mahasiswa dan dosen, tetapi juga turut meningkatkan reputasi institusi dan kontribusi IPB University pada pengembangan ilmu pengetahuan tingkat dunia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel3.jpg',
                'judul' => 'Inovasi Kayu Magnet: Penelitian Dosen Departemen Hasil Hutan IPB University Hadirkan Material Fungsional Ramah Lingkungan',
                'tanggal' => now(),
                'deskripsi' => 'Sebagai bagian dari universitas yang berfokus pada riset berbasis biodiversitas tropika, IPB University kembali menunjukkan kiprahnya melalui inovasi material ramah lingkungan. Salah satu hasil penelitian unggulan berasal dari Departemen Hasil Hutan (DHH), Fakultas Kehutanan dan Lingkungan, yaitu pengembangan material kayu magnet.

Inovasi ini digagas oleh Dr. Istie Sekartining Rahayu, dosen sekaligus peneliti dari Departemen Hasil Hutan IPB University. Ia menjelaskan bahwa kayu magnet merupakan material hasil rekayasa dari kayu yang semula tidak memiliki sifat magnetik, namun setelah diberi perlakuan khusus dapat tertarik oleh magnet.

“Kayu dimodifikasi menggunakan bahan magnetik, baik berupa serbuk maupun fluida. Prosesnya dapat dilakukan melalui beberapa metode, seperti pelapisan (coating), pencampuran serbuk kayu dengan bubuk magnet, atau dengan cara impregnasi menggunakan larutan magnetik,” jelas Dr. Istie.

Dalam penelitian ini, tim menggunakan metode coating dengan spraygun dan impregnasi larutan nanomagnetit. Inovasi ini tergolong ramah lingkungan karena bahan bakunya berasal dari limbah kayu berukuran kecil, sedangkan pembuatan nanomagnetit dilakukan dengan metode kopresipitasi yang tidak mencemari lingkungan.

Selain ramah lingkungan, kayu magnet juga memiliki fungsi tambahan yang sangat menarik, yaitu kemampuannya menyerap gelombang elektromagnetik yang dihasilkan oleh perangkat elektronik seperti televisi, ponsel, tablet, dan laptop. Menurut Dr. Istie, kemampuan ini penting karena paparan gelombang elektromagnetik berpotensi menimbulkan efek fisiologis maupun psikologis pada manusia.

Dalam tahap pengembangannya, tim peneliti telah menciptakan magnetic stand holder untuk ponsel yang berfungsi menyerap gelombang elektromagnetik terutama saat proses pengisian daya berlangsung. “Ke depan, tantangan yang dihadapi adalah perizinan edar dan pengembangan variasi produk agar dapat digunakan pada perangkat lain seperti laptop atau casing handphone,” ujarnya.

Penelitian ini mendapat dukungan dari Lembaga Kawasan Sains dan Teknologi (LKST) IPB University bekerja sama dengan Asian Development Bank (ADB) melalui program PRIMESTeP dengan skema A–Kerja Sama Industri. Melalui kolaborasi ini, inovasi kayu magnet difasilitasi hingga tahap hilirisasi bersama mitra industri Hudricore.

Dengan potensi penerapan di berbagai sektor industri kreatif—mulai dari mainan edukatif, dekorasi magnetik, stand holder, hingga elemen furnitur—inovasi kayu magnet menjadi bukti nyata komitmen Departemen Hasil Hutan IPB University dalam menghadirkan solusi berkelanjutan berbasis sumber daya alam hayati.

Melalui penelitian berkelanjutan seperti ini, Departemen Hasil Hutan terus mendukung IPB University dalam mewujudkan visi sebagai Kampus Biodiversitas, yang aktif menciptakan teknologi inovatif dan ramah lingkungan bagi masa depan.

Sumber: IPB News – Inovasi Kayu Magnet, Material Fungsional Ramah Lingkungan dari Dosen IPB University
Diterbitkan ulang oleh Departemen Hasil Hutan, Fakultas Kehutanan dan Lingkungan, IPB University',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel4.png',
                'judul' => 'Dosen Departemen Hasil Hutan inisiasi kerjasama dengan University of Tokyo, Japan',
                'tanggal' => now(),
                'deskripsi' => 'Tokyo, 1 Oktober 2025 — Dalam rangka menindaklanjuti rencana kerja sama antara pihak Indonesia — yang terdiri atas Departemen Hasil Hutan, Fakultas Kehutanan dan Lingkungan IPB University, serta Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan Institut Teknologi Bandung — dengan pihak Jepang, yaitu PT Iida Group Holdings dan University of Tokyo, sejumlah dosen Departemen Hasil Hutan melakukan kunjungan akademik ke Jepang.

Kunjungan ini merupakan bagian dari upaya bersama untuk mewujudkan proyek pembangunan rumah kayu di Kampus IPB Dramaga, Bogor, sekaligus memperluas jejaring kolaborasi riset di bidang kehutanan, arsitektur, dan teknologi kayu berkelanjutan.

Lawatan tim berlangsung pada 29 September hingga 4 Oktober 2025, dengan agenda kunjungan ke beberapa institusi penting di Jepang, di antaranya Kedutaan Besar Republik Indonesia untuk Jepang, University of Tokyo, Osaka Expo 2025, dan Miyamoto Kogyo Co. Ltd.

Tim Departemen Hasil Hutan IPB yang terdiri dari Prof. Naresworo Nugroho, Dr. Istie S. Rahayu, Prof. Imam Wahyudi, Prof. Lina Karlinasari, dan Dr. Arinana disambut oleh Prof. Dr. Kenji Aoki di Wood-Based Materials and Timber Engineering Laboratory, Graduate School of Agricultural and Life Sciences, University of Tokyo, pada Rabu, 1 Oktober 2025.

Kunjungan ini dimaksudkan untuk memperdalam peluang kerja sama akademik antara IPB University dan University of Tokyo, tidak hanya dalam bidang pertanian dan lingkungan, tetapi juga kemungkinan pengembangan kolaborasi lintas disiplin seperti teknik dan rekayasa struktur kayu.

Dalam pertemuan tersebut, Prof. Kenji Aoki memaparkan kondisi sumber daya hutan dan industri kayu di Jepang. Ia menjelaskan bahwa Jepang memiliki kekayaan sumber daya hutan yang sangat besar, di mana sekitar dua pertiga wilayahnya merupakan kawasan hutan. Selain memanfaatkan kayu lokal, industri Jepang juga mengimpor kayu dari berbagai negara untuk memenuhi kebutuhan materialnya.

Jenis kayu yang paling banyak digunakan di Jepang antara lain Japanese cedar (Sugi), Japanese cypress (Hinoki), dan Japanese larch (Karamatsu). Produk olahan kayu yang banyak digunakan meliputi sawn timber, laminated veneer lumber (LVL), glulam, dan cross-laminated timber (CLT).

Prof. Kenji juga memperkenalkan sejumlah bangunan berstruktur kayu yang telah berdiri di Jepang, termasuk konstruksi hybrid kayu dan baja, seperti “M Building” di Kanazawa, Marumi Corporation di Nagoya, dan Polus Corporation di Saitama. Ia menambahkan bahwa saat ini Jepang tengah membangun gedung kantor pusat setinggi 100 meter dengan 20 lantai berbahan dasar kayu, yang dikenal sebagai “Wooden Head Office Building” di Tokyo.

Melalui kunjungan ini, diharapkan kolaborasi antara IPB University dan University of Tokyo dapat terus berkembang dalam bentuk penelitian bersama, pertukaran akademik, dan pengembangan teknologi material kayu yang mendukung keberlanjutan lingkungan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel5.png',
                'judul' => 'Dosen Departemen Hasil Hutan Inisiasi Kerja Sama dengan Atase Pendidikan dan Kebudayaan Kedutaan Indonesia untuk Jepang',
                'tanggal' => now(),
                'deskripsi' => 'Tokyo, 30 September 2025 — Dalam rangka memperkuat kolaborasi akademik dan penelitian internasional, tim dosen Departemen Hasil Hutan (DHH), Fakultas Kehutanan dan Lingkungan IPB University, melakukan kunjungan ke Kedutaan Besar Republik Indonesia (KBRI) untuk Jepang di Tokyo pada Selasa, 30 September 2025.

Kunjungan ini merupakan bagian dari rangkaian kegiatan kerja sama antara pihak Indonesia — yang terdiri atas Departemen Hasil Hutan, Fakultas Kehutanan dan Lingkungan IPB University, serta Sekolah Arsitektur, Perencanaan, dan Pengembangan Kebijakan Institut Teknologi Bandung — dengan pihak Jepang, yakni PT Iida Group Holdings dan University of Tokyo. Kolaborasi ini bertujuan untuk membangun rumah kayu percontohan di Kampus IPB Dramaga, Bogor, sebagai bagian dari pengembangan riset dan inovasi dalam bidang konstruksi kayu berkelanjutan.

Selama kunjungan yang berlangsung pada 29 September hingga 4 Oktober 2025, tim DHH IPB yang terdiri dari Prof. Naresworo Nugroho, Dr. Istie S. Rahayu, Prof. Imam Wahyudi, Prof. Lina Karlinasari, dan Dr. Arinana melakukan lawatan ke beberapa institusi di Jepang. Rangkaian kunjungan tersebut meliputi Kedutaan Besar Republik Indonesia untuk Jepang, University of Tokyo, Osaka Expo 2025, dan Miyamoto Kogyo Co. Ltd.



Pada pertemuan dengan Atase Pendidikan dan Kebudayaan (Atdikbud) KBRI Tokyo, Prof. Dr. Amzul Rifin, S.P., M.A., pihak KBRI menyambut baik inisiatif kerja sama yang dilakukan oleh Fakultas Kehutanan dan Lingkungan IPB University. Prof. Amzul juga menyatakan dukungannya terhadap rencana kegiatan magang mahasiswa Indonesia di perusahaan Jepang yang bergerak di bidang kehutanan dan teknologi kayu.

Beliau menekankan pentingnya pembekalan keterampilan khusus bagi mahasiswa sebelum mengikuti program magang, terutama kemampuan berbahasa Jepang, agar mereka dapat beradaptasi dengan baik selama bekerja di lingkungan industri Jepang. Selain itu, Prof. Amzul berharap kegiatan magang ini dapat menjadi sarana untuk memperluas wawasan, pengetahuan, pengalaman, serta jejaring profesional mahasiswa di tingkat internasional.

Lebih lanjut, Prof. Amzul juga menyampaikan bahwa saat ini semakin banyak mahasiswa Indonesia yang menempuh pendidikan di berbagai universitas ternama di Jepang, mulai dari jenjang Sarjana, Magister, hingga Doktor, yang menunjukkan kuatnya hubungan akademik antara kedua negara.

Melalui inisiatif kerja sama ini, Departemen Hasil Hutan IPB University berharap dapat memperluas jejaring akademik internasional, memperkuat riset di bidang teknologi kayu dan kehutanan tropis, serta berkontribusi dalam mewujudkan pembangunan berkelanjutan melalui penerapan ilmu pengetahuan dan inovasi dalam Tri Dharma Perguruan Tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel6.jpg',
                'judul' => '[Erasmus Mobility 2025 – Teaching Programme] Pawel Czarniak, Ph.D. from Warsaw University of Life Sciences (WULS), Poland.',
                'tanggal' => now(),
                'deskripsi' => 'Erasmus Mobility 2025 – Teaching Programme 

From September 8–11, 2025, the Department of Forest Products, IPB University had the honor of welcoming Pawel Czarniak, Ph.D. from Warsaw University of Life Sciences (WULS), Poland.

During his visit, Dr. Czarniak delivered inspiring lectures and shared valuable insights in the field of forest products, while also strengthening our international collaboration and academic partnership.

Thank you for the fruitful discussions and knowledge exchange, Dr. Czarniak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 2,
                'id_sdgs' => 1,
                'foto' => 'img/artikel7.png',
                'judul' => 'DHH Menyerahan Mahasiswa PKL TA 2024/2025 (Angkatan 59) di Jawa Barat, Jawa Tengah dan Jawa TImur)',
                'tanggal' => now(),
                'deskripsi' => 'Setelah melaksanakan kegiatan kuliah pembekalan PKL di bulan Agustus 2025 serta diikuti dengan acara pelepasan mahasiswa PKL diharapkan dapat memberikan banyak manfaat/benefit kepada mitra, diantaranya sebagai berikut :

1. Pihak mitra dapat memanfaatkan hasil kerja serta laporan kegiatan PKL mahasiswa/i,
2. Mahasiswa dapat membantu meringankan kegiatan operasional dan promosi mitra selama pelaksanaan kegiatan PKL
3. Jika ditemui kendala dalam kegiatan operasional dan promosi, pihak mitra dapat berkonsultasi dengan PS THH via mahasiswa dalam rangka menindaklanjuti penyelesaian kendala
4. Memberikan kesempatan kepada mitra untuk membangun kerjasama riset dengan akademisi
Kegiatan PKL memberikan banyak manfaat kepada mahasiswa seperti memberikan wawasan dan pengalaman berkegiatan di industry hasil hutan. Selain itu juga mempelajari berbagai proses produksi di industry hasil hutan (lokasi PKL).

DHH telah bermitra dengan 27 industry hasil hutan yang tersebar di 6 provinsi, yaitu DKI Jakarta, Banten, Jawa Barat, Jawa Tengah dan Jawa Timur serta Riau. Sebelas industry di area propinsi Jawa Tengah, 3 industry di Propinsi Banten, 7 industry di Propinsi Jawa Barat, 3 industry di Jawa Timur dan 1 industri di provinsi Riau. Adapun industry yang menjadi lokasi PKL terdiri dari industry kayu dan industry bukan kayu, meliputi industry mebel, kayu lapis, pulp dan kertas serta getah.

PKL akan berlangsung selama kurang lebih 40 hari kerja, dimulai dari tanggal 25 Agustus 2025 sampai dengan 17 Oktober 2025

Untuk itu, bidang praktik di lokasi PKL mencakup semua kegiatan di industry hasil hutan, yaitu bidang:

1. Bahan baku: jenis dan spesifikasi bahan baku, suplai bahan baku, karakteristik dan mutu bahan baku, penanganan bahan baku.
2. Teknologi proses: tahapan dan layout proses, faktor-faktor produksi, jenis dan fungsi mesin produksi, jenis dan spesifikasi produk, rendemen produk, pengujian mutu produk, jenis dan fungsi bahan pendukung/penolong produksi, pemeliharaan mesin.
3. Manajemen industri dan pemasaran: optimalisasi produksi, riset operasi, pengendalian mutu, nilai tambah produk, kesehatan dan keselamatan kerja, pemasaran dan bisnis kehutanan.
4. Penanganan dan pemanfaatan limbah: penanganan limbah industri, pemanfaatan hasil samping (untuk energi, kerajinan, produk lainnya).
5. Inovasi dan Pengembangan produk: teknologi peningkatan mutu kayu dan produk, inovasi produk, diversifikasi produk dan pengembangan bahan baku dan produk kreatif masa depan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 2,
                'id_sdgs' => 1,
                'foto' => 'img/artikel8.png',
                'judul' => 'DHH Melaksanakan Kuliah Pembekalan PKL TA 2024/2025 (Angkatan 59)',
                'tanggal' => now(),
                'deskripsi' => 'Salah satu program dari kebijakan Kementerian Pendidikan dan Kebudayaan adalah Merdeka Belajar – Kampus Merdeka.  Sesuai dengan Permendikbud No. 3 Tahun 2020 tentang Standar Nasional Pendidikan Tinggi, mahasiswa memiliki hak belajar tiga semester di luar program studi.  IPB telah mencanangkan Kurikulum K2020 dalam rangka mencapai visi IPB 2019-2045: menjadi techno-socio entrepreneurial university yang terdepan dalam memperkokoh martabat bangsa melalui pendidikan tinggi unggul pada tingkat global di bidang pertanian, kelautan dan biosains tropika.

Untuk menyikapi kebijakan tersebut PS THH telah melakukan reorientasi kurikulum sesuai dengan kebijakan pemerintah tentang MBKM. Pada struktur K2020 terdapat enrichment courses/programs yang mendorong program studi untuk menyiapkan berbagai program kegiatan dan inovasi pembelajaran yang mendukungnya bekerjsama dengan mitra dunia usaha dan dunia industri (DUDI). Praktik Kerja Lapang (PKL) adalah salah satu bentuk mata kuliah PS THH yang dapat dintegrasikan dengan MBKM, tugas akhir mahasiswa, dan pengabdian kepada masyarakat. Keberhasilan kegiatan ini ditentukan oleh keterlibatan mitra industri dalam perencanaan, pelaksanaan, pembimbingan, dan evaluasi kegiatan; sehingga diharapkan kedua pihak dapat memperoleh manfaat.

Oleh karena itu tahun ini, DHH Kembali menyelenggarakan Kuliah Pembekalan PKL yang dilaksanakan pada tanggal Rabu-Kamis / 13-14 Agustus 2025, bertempat di Wing R Fahutan IPB. Kuliah Pembekalan PKL menghadirkan narasumber dari internal maupun eksternal kampus. Dari Departemen Hasil Hutan (DHH) IPB, dosen turut memberikan pembekalan, serta dihadirkan praktisi dan pakar dari luar kampus, diantaranya :

1. Materi tentang Desain dan Inovasi Produk Hasil Hutan
(Imam Damar Djati, Ph.D. – Fakultas Seni Rupa ITB)
2. Kesehatan dan Keselamatan Kerja (K3)
(Erwin Santosa, Total Energies)
3. Pengolahan Hasil Hutan Bukan Kayu
(Ir. Doddy Juli Irawan, S.Hut, M.Env.Sc – Perhutani)
4. Bisnis dan Pemasaran
(Ir. Anggar Widiyatmoko)
Setelah melaksanakan kuliah pembekalan, para mahasiswa bersiap-siap untuk berangkat PKL ke berbagai lokasi industry hasil hutan (27 lokasi industry hasil hutan) yang tersebar di wilayah Provinsi Jawa Barat, Jawa Tengah dan Jawa Timur serta Riau.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 1,
                'id_sdgs' => 1,
                'foto' => 'img/artikel9.jpg',
                'judul' => 'DHH menerima Kunjungan Civitas Akademika dari Kangwon National University (KNU), Korea Selatan',
                'tanggal' => now(),
                'deskripsi' => 'Bogor, 24 Januari 2025 – Departemen Hasil Hutan, Fakultas Kehutanan dan Lingkungan, Institut Pertanian Bogor (IPB) menerima kunjungan civitas akademika dari Kangwon National University (KNU), Korea Selatan, dalam rangka mempererat kerja sama akademik dan penelitian di bidang pengolahan hasil hutan.



Kunjungan ini dihadiri oleh perwakilan dari KNU yang dipimpin oleh Dr. Se-Yeong Park, serta mahasiswa dan civitas akademika dari Department of Forest Materials Engineering, KNU, diantaranya Ji – Yeon Sim, Yong – Hui CHOZ, Sang Jun Lee, dan Denni Prasetia. Sementara itu, pihak IPB diwakili oleh Dekan Fakultas Kehutanan dan Lingkungan IPB, Prof. Dr. Ir. Naresworo Nugroho, MS; Sekretaris Departemen Hasil Hutan, Irsan Alipraja, Ph.D.; beserta para kepala divisi; serta beberapa dosen DHH, diantaranya Dr. Ir. Rita Kartika Sari, MS.; Dr. Arinana, S.Hut., M.Si; dan Ketua Satuan Usaha Akademik DHH, Dr. Yanico Hadi Prayogo, S.Si., M.Si.





 

 

 

 

 

Dalam pertemuan tersebut, kedua belah pihak membahas berbagai penelitian terkini di bidang pengolahan hasil hutan di kedua institusi, serta peluang kerja sama, termasuk pertukaran mahasiswa, penelitian bersama terkait pemanfaatan hasil hutan kayu dan non kayu, serta pengembangan teknologi pengolahan kayu dan non-kayu yang ramah lingkungan. Diskusi juga menyoroti potensi kolaborasi dalam hal peningkatan mutu bambu.

Sementara itu, Dr. Se-Yeong Park menyampaikan apresiasinya atas sambutan hangat dari IPB dan menyampaikan peluang untuk meningkatkan kerja sama yang saling menguntungkan di masa mendatang.

Sebagai bagian dari kunjungan ini, delegasi KNU juga diajak berkeliling laboratorium penelitian hasil hutan di DHH untuk melihat secara langsung fasilitas dan proyek riset yang sedang berjalan.



Kunjungan ini diharapkan menjadi langkah awal yang memperkuat hubungan akademik antara IPB dan KNU, sekaligus mendorong kerja sama yang lebih luas di masa depan dalam pengembangan ilmu dan teknologi hasil hutan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_kategoriartikel' => 2,
                'id_sdgs' => 1,
                'foto' => 'img/artikel10.jpg',
                'judul' => 'Kuliah Pembekalan PKL TA 2023/2024 (Angkatan 58)',
                'tanggal' => now(),
                'deskripsi' => 'Salah satu program dari kebijakan Kementerian Pendidikan dan Kebudayaan adalah Merdeka Belajar – Kampus Merdeka.  Sesuai dengan Permendikbud No. 3 Tahun 2020 tentang Standar Nasional Pendidikan Tinggi, mahasiswa memiliki hak belajar tiga semester di luar program studi.  IPB telah mencanangkan Kurikulum K2020 dalam rangka mencapai visi IPB 2019-2045: menjadi techno-socio entrepreneurial university yang terdepan dalam memperkokoh martabat bangsa melalui pendidikan tinggi unggul pada tingkat global di bidang pertanian, kelautan dan biosains tropika.

Untuk menyikapi kebijakan tersebut PS THH telah melakukan reorientasi kurikulum sesuai dengan kebijakan pemerintah tentang MBKM. Pada struktur K2020 terdapat enrichment courses/programs yang mendorong program studi untuk menyiapkan berbagai program kegiatan dan inovasi pembelajaran yang mendukungnya bekerjsama dengan mitra dunia usaha dan dunia industri (DUDI). Praktik Kerja Lapang (PKL) adalah salah satu bentuk mata kuliah PS THH yang dapat dintegrasikan dengan MBKM, tugas akhir mahasiswa, dan pengabdian kepada masyarakat. Keberhasilan kegiatan ini ditentukan oleh keterlibatan mitra industri dalam perencanaan, pelaksanaan, pembimbingan, dan evaluasi kegiatan; sehingga diharapkan kedua pihak dapat memperoleh manfaat. Oleh karena itu tahun ini, DHH Kembali menyelenggarakan kuliah pembekalan PKL yang dilaksanakan pada tanggal Rabu-Kamis / 21-22 Agustus 2024, tempat di Wing R Fahutan IPB.



Kuliah pembekalan PKL mengundang narasumber/praktisi berasal dari dosen DHH serta dari luar kampus. Secara detail jadwal kuliah pembekalan dapat dilihat pada link beirkut : https://ipb.link/pembekalanpkl-dhh-2024. Setelah melaksanakan kuliah pembekalan, para mahasiswa bersiap-siap untuk berangkat PKL ke berbagai lokasi industry hasil hutan (23 lokasi industry hasil hutan) yang tersebar di wilayan Propinsi Banten, Jawa Barat dan Jawa Tengah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
        ]);    
        
    }
}
