@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan S2</span>
</div>
<!-- === Profil Program Studi === -->
<section class="pend-section">
  <div class="pend-container" data-aos="fade-up">

    <!-- Kiri: Teks -->
    <div class="pend-text">
      <h3>Profil Program Studi S2</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
      <p>
        Program Studi S3 Hasil Hutan (PS HH) telah mendapatkan akreditasi A dari Badan Akreditasi Nasional Perguruan Tinggi Republik Indonesia (BAN-PT) pada tahun 2006. 
        Pada tahun 2011, PS THH juga telah terakreditasi A oleh BAN-PT. Akreditasi tersebut berlaku sejak tanggal 29 Desember 2011 sampai dengan 29 Desember 2016.
      </p>
      <p>
        Selain mendapatkan akreditasi tingkat nasional, PS THH memperoleh Akreditasi Internasional dari The Society of Wood Science and Technology (SWST) yang berkantor pusat di Monona, Wisconsin, Amerika Serikat. 
        Akreditasi diberikan selama sepuluh tahun, mulai dari 1 Januari 2015 sampai dengan 1 Januari 2025.
      </p>
    </div>

    <!-- Kanan: Gambar -->
    <div class="pend-image">
      <img src="{{ asset('img/mhsdhh.png') }}" alt="Mahasiswa DHH">
    </div>
  </div>
</section>

<!-- === Kompetensi Lulusan === -->
<section class="pend-section" data-aos="fade-up">
  <div class="pend-text">
    <h3>Kompetensi Lulusan</h3>
    <img src="{{ asset('img/batasgold.png') }}" alt="divider">
  </div>
    <p style="text-align: justify;">
      Kompetensi Lulusan PS THH adalah mempunyai Dasar Ketrampilan, Kemampuan Analisis dan Sintesis yang andal, 
      serta Profesionalisme dan Kemandirian yang kuat pada bidang ilmu dan teknologi hasil hutan serta berjiwa kewirausahaan. 
      Kompetensi tersebut dijabarkan dalam 4 bagian, yaitu:
    </p>
    <ul style="text-align: justify;">
      <li>Kompetensi Bagian Peningkatan Kualitas Kayu (anatomi kayu, sifat-sifat kayu, kualitas kayu, pengendalian rayap, dan pengeringan kayu)</li>
      <li>Kompetensi Bagian Biokomposit (teknologi biokomposit, teknologi perekatan kayu, dan analisis kuantitatif dan ekonomi hutan)</li>
      <li>Kompetensi Bagian Rekayasa dan Desain Bangunan Kayu (keteknikan kayu, sifat fisik dan mekanisme kayu, uji destruktif kayu, dan proteksi bangunan kayu)</li>
      <li>Kompetensi Bagian Kimia Hasil Hutan (kimia hasil hutan, teknologi pulp dan kertas, dan pengolahan hasil hutan non kayu)</li>
    </ul>
  </div>
</section>

<!-- === Capaian Pembelajaran === -->
<section class="pend-section" data-aos="fade-up">
  <div class="pend-text">
    <h3>Capaian Pembelajaran</h3>
    <img src="{{ asset('img/batasgold.png') }}" alt="divider">
  </div>

  <ol class="pend-list" style="text-align: justify;">
    <li>Menunjukkan sikap jujur, mandiri, humanis, berfikiran luas, beretika, dan bertanggung jawab atas pekerjaan di bidang keahliannya.</li>
    <li>Mampu menerapkan pemikiran logis, kritis, sistematis, kreatif, inovatif, dan berkomunikasi secara efektif dalam memecahkan masalah.</li>
    <li>Menguasai konsep teoritis umum ilmu kehutanan (pengelolaan hutan lestari) yang mencakup pendirian, pelestarian, pemanenan, pemrosesan, dan pemasaran.</li>
    <li>Mampu menerapkan ilmu dan teknologi peningkatan kualitas hasil hutan melalui proses permesinan, pengeringan, pengawetan, dan pemrosesan akhir.</li>
    <li>Mampu menerapkan ilmu dan teknologi hasil hutan di bidang biokomposit dan proses pengujian bahan baku.</li>
    <li>Mampu menerapkan prinsip-prinsip kimia dalam efisiensi pemanfaatan sumber daya hasil hutan.</li>
    <li>Mampu menerapkan teknologi dan seni hasil hutan di bidang kekuatan material, desain, serta analisis struktural.</li>
    <li>Mampu menerapkan ilmu dan teknologi di bidang manajemen produksi, pemasaran, dan efisiensi industri hasil hutan.</li>
    <li>Mampu merancang dan melaksanakan penelitian dengan metodologi yang benar dan menganalisis data dengan tepat.</li>
  </ol>

  <!-- Leaflet (Flayer) -->
  <div class="pend-flayer row mt-4">
    <div class="col-md-6 mb-3">
      <img src="{{ asset('img/leaflet1.png') }}" class="img-fluid rounded shadow-sm" alt="Leaflet 1">
    </div>
    <div class="col-md-6 mb-3">
      <img src="{{ asset('img/leaflet2.png') }}" class="img-fluid rounded shadow-sm" alt="Leaflet 2">
    </div>
  </div>
</section>

<!-- === Kurikulum === -->
<section class="pend-section" data-aos="fade-up">
  <div class="pend-text">
    <h3>Kurikulum dan Mata Kuliah</h3>
    <img src="{{ asset('img/batasgold.png') }}" alt="divider">
  </div>
  <p style="text-align: justify;">
    Silakan kunjungi laman 
    <a href="https://panduan.ipb.ac.id" target="_blank">panduan.ipb.ac.id</a>
    untuk melihat informasi lengkap mengenai mata kuliah dan kurikulum.
  </p>
</section>

<!-- === Akreditasi Nasional === -->
<section class="pend-section" data-aos="fade-up">
  <div class="pend-text">
    <h3>Akreditasi Nasional</h3>
    <img src="{{ asset('img/batasgold.png') }}" alt="divider">
  </div>
  <div class="text-center">
    <img src="{{ asset('img/akreditasis1.jpg') }}" alt="Sertifikat Akreditasi" class="img-fluid rounded shadow-sm my-3" style="max-width: 400px;">
  </div>
  <p class="text-center" style="text-align: justify;">
    Program Studi Sarjana Teknologi Hasil Hutan Departemen Hasil Hutan Fakultas Kehutanan & Lingkungan IPB University telah terakreditasi A 
    berdasarkan Keputusan BAN-PT NOMOR: 13986/SK/BAN-PT/Ak-PPJ/S/XII/2021.
  </p>
</section>

<script>
AOS.init({
  duration: 1000,
  once: true
});
</script>

@endsection
