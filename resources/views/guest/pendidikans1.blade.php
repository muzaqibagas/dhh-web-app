@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan S1</span>
</div>

  <div class="container my-5">
        <div class="guest-about-container">

            <!-- KIRI: TEKS -->
            <!-- KANAN: FOTO -->
            <div class="guest-about-image" data-aos="fade-up">
                <img src="img/mhsdhh.png" alt="Mahasiswa DHH">
            </div>

            <div class="guest-about-text" data-aos="fade-up">
            <h4 class="guest-pend-section-title">Profil Program Studi S1</h4>
            <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
                <p style="text-align: justify;">
                  Program Studi S2 Ilmu dan Teknologi Hasil Hutan IPB berkomitmen menjadi pusat unggulan
                  dalam pendidikan, penelitian, dan inovasi teknologi pemanfaatan hasil hutan secara berkelanjutan.
                  Program ini menghasilkan lulusan berkualifikasi tinggi yang mampu mengembangkan ilmu, teknologi,
                  dan seni di bidang hasil hutan melalui pendekatan interdisipliner dan riset yang teruji.
                </p>

                
            <h4 class="guest-pend-section-title">Kompetensi Lulusan</h4>
            <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
            <p style="text-align: justify;">
                Kompetensi lulusan PS THH adalah mempunyai Dasar Ketrampilan, Kemampuan Analisis dan Sintesis yang andal, 
                serta Profesionalisme dan Kemandirian yang kuat pada bidang ilmu dan teknologi hasil hutan serta berjiwa kewirausahaan. 
                Kompetensi tersebut dijabarkan dalam 4 bagian, yaitu:
            </p>
            <ul style="text-align: justify;">
              <li>Kompetensi Bagian Peningkatan Kualitas Kayu (anatomi kayu, sifat-sifat kayu, kualitas kayu, pengendalian rayap, dan pengeringan kayu)</li>
              <li>Kompetensi Bagian Biokomposit (teknologi biokomposit, teknologi perekatan kayu, dan analisis kuantitatif dan ekonomi hutan)</li>
              <li>Kompetensi bagian Rekayasa dan Desain Bangunan Kayu (keteknikan kayu, sifat fisik dan mekanisme kayu, uji destruktif kayu, dan proteksi bangunan kayu)</li>
              <li>Kompetensi Bagian Kimia Hasil Hutan (kimia hasil hutan, teknologi pulp dan kertas, dan pengolahan hasil hutan non kayu)</li>
            </ul>
            </div>

        </div>
    </section>

    <script>
        AOS.init({
            duration: 1000,  /* animasi 1 detik */
            once: true       /* hanya sekali muncul */
        });
    </script>

  <!-- Capaian Pembelajaran -->
  <h3 class="guest-pend-section-title">Capaian Pembelajaran</h3>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
    <ol style="text-align: justify;">
      <li>Menunjukkan sikap jujur, mandiri, humanis, berfikiran luas, beretika,motivasi tinggi sebagai pembelajar,dan bertanggung jawab atas pekerjaan di bidang keahliannya</li>
      <li>Mampu menerapkan pemikiran logis,kritis, sistematis, kreatif, inovatif, dan memiliki kemampuan berkomunikasi secara efektif dan bekerjasama dalam memecahkan masalah.</li>
      <li>Menguasai konsep teoritis umum ilmu kehutanan (pengelolaan hutan lestari) yang mencakup pendirian, pelestarian, pemanenan, pemrosesan dan pemasaran.</li>
      <li>Mampu menerapkan ilmu pengetahuan dan teknologi peningkatan kualitas hasil hutan melalui proses permesinan, pengeringan, pengawetan dan pemrosesan akhir yang didukung oleh sifat-sifat kayu dan ilmu struktur kayu.</li>
      <li>Mampu menerapkan ilmu, teknologi, dan seni hasil hutan di bidang pemilihan bahan baku, proses pengujian dan persiapan produk biokomposit.</li>
      <li>Mampu menerapkan ilmu pengetahuan dan teknologi hasil hutan berdasarkan prinsip-prinsip kimia untuk meningkatkan efisiensi pemanfaatan sumber daya.</li>
      <li>Mampu menerapkan ilmu pengetahuan, teknologi, dan seni pemanfaatan hasil hutan di bidangkekuatan material, desain dan manajemen, analisis struktural, teknik kayu dan upaya perlindungan bangunan.</li>
      <li>Mampu menerapkan ilmu pengetahuan, teknologi dan seni pemanfaatan hasil hutan di bidang manajemen produksi, pemasaran dan perdagangan produk hutan, dan efisiensi industri hasil hutan.</li>
      <li>Mampu merancang dan melaksanakan penelitian dengan metodologi yang benar dan menganalisa serta menginterpretasikan data dengan tepat.</li>
    </ol>
    <!-- Leaflet -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <img src="img/leaflet1.png" class="img-fluid rounded" alt="Leaflet 1">
        </div>
        <div class="col-md-6 mb-3">
            <img src="img/leaflet2.png" class="img-fluid rounded" alt="Leaflet 2">
        </div>
    </div>

    <h4 class="guest-pend-section-title">Kurikulum dan Mata Kuliah</h4>
    <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
    <p style="text-align: justify;">
      Silakan kunjungi laman <a href="https://panduan.ipb.ac.id" target="_blank">panduan.ipb.ac.id</a> 
      untuk melihat informasi lengkap mengenai mata kuliah dan kurikulum.
    </p>

    <h4 class="guest-pend-section-title">Akreditasi Nasional</h4>
    <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
    <img src="img/akreditasis1.jpg" alt="Sertifikat Akreditasi" class="img-fluid border rounded mx-auto d-block" style="max-width: 400px;">
    <p style="text-align: justify;">
      Program Studi Sarjana Teknologi Hasil Hutan Departemen Hasil Hutan Fakultas Kehutanan & Lingkungan IPB University telah terakreditasi A 
      Berdasarkan Keputusan BAN-PT NOMOR : 13986/SK/BAN-PT/Ak-PPJ/S/XII/2021
    </p>
  </div>
  </div>
</div>

@endsection