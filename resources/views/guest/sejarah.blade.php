@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>

<div class="container my-5">

  <!-- SEJARAH -->
   <section class="sej-section">
  <h2 class="guest-pend-section-title">Sejarah</h2>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <p style="text-align: justify;">
    Departemen Hasil Hutan (DHH) yang sebelumnya bernama Departemen Teknologi Hasil Hutan berdiri pada tahun 1969.
    DHH adalah Departemen Hasil Hutan pertama di Indonesia dan memiliki fokus pada pengembangan bidang keilmuan
    dan teknologi hasil hutan yang mencakup kimia hasil hutan, biokomposit, teknologi peningkatan kualitas kayu,
    dan desain serta keteknikan struktur kayu.
  </p>
<!-- KETUA DARI MASA KE MASA -->
<section class="guest-ketua-section my-5">
  <h2 class="guest-pend-section-title text-center">Ketua Departemen dari Masa ke Masa</h2>
  <img src="img/batasgold.png" class="guest-pend-divider d-block mx-auto" alt="divider">

  <div class="guest-ketua-timeline d-flex flex-wrap justify-content-center gap-4 mt-4">
    <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 1">
      <h5>Dr. Nama Ketua</h5>
      <p>1969 – 1975</p>
    </div>
    <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 2">
      <h5>Prof. Nama Ketua</h5>
      <p>1975 – 1985</p>
    </div>
    <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 3">
      <h5>Ir. Nama Ketua</h5>
      <p>1985 – 1995</p>
    </div>
        <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 1">
      <h5>Dr. Nama Ketua</h5>
      <p>1969 – 1975</p>
    </div>
    <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 2">
      <h5>Prof. Nama Ketua</h5>
      <p>1975 – 1985</p>
    </div>
    <div class="guest-ketua-card text-center">
      <img src="img/pairsan.jpg" alt="Ketua 3">
      <h5>Ir. Nama Ketua</h5>
      <p>1985 – 1995</p>
    </div>
  </div>
</section>

  <!-- VISI & MISI -->
  <div class="row my-4">
    <div class="col-lg-6 col-md-12 mb-4">
      <h3 class="guest-pend-section-title">Visi</h3>
      <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
      <p style="text-align: justify;">
        Menjadi lembaga pendidikan tinggi bertaraf internasional dalam menghasilkan SDM bermutu dan
        mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan.
      </p>
    </div>
    <div class="col-lg-6 col-md-12 mb-4">
      <h3 class="guest-pend-section-title">Misi</h3>
      <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
      <p style="text-align: justify;">
        Menyelenggarakan program tri dharma untuk menghasilkan sumberdaya manusia berkualifikasi sarjana
        dengan kompetensi utama teknologi hasil hutan dan mengembangkan inovasi IPTEKS untuk berkontribusi
        terhadap peningkatan produktifitas dan efisiensi industri hasil hutan.
      </p>
    </div>
  </div>

  <!-- TUJUAN -->
  <h3 class="guest-pend-section-title">Tujuan</h3>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <ul style="text-align: justify;">
    <li>Mengoptimalkan pengembangan kapasitas sumberdaya melalui kerjasama di bidang pendidikan, penelitian, dan publikasi.</li>
    <li>Mengoptimalkan pemberdayaan IPTEKS hasil hutan melalui pengajaran, penelitian, publikasi, serta pelayanan pada masyarakat.</li>
    <li>Mewujudkan manajemen penyelenggaraan departemen yang bermutu sesuai standar Tri Dharma Perguruan Tinggi.</li>
    <li>Menghasilkan lulusan yang berdaya saing, profesional, dan berjiwa kewirausahaan.</li>
  </ul>

  <!-- KEBIJAKAN MUTU -->
  <h3 class="guest-pend-section-title">Kebijakan Mutu</h3>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <p style="text-align: justify;">
    Untuk mendukung pengembangan IPB sebagai perguruan tinggi berdaya saing tinggi dan berkompetisi secara sehat,
    Departemen Hasil Hutan menerapkan kebijakan mutu dengan prinsip:
  </p>
  <ol class="guest-text">
    <li>Berpedoman pada aturan yang berlaku.</li>
    <li>Melaksanakan internasionalisasi standar mutu penyelenggaraan akademik dan riset.</li>
    <li>Meningkatkan kualitas input dan proses serta non akademik.</li>
    <li>Meningkatkan jumlah publikasi, sitasi, dan teknologi aplikasi.</li>
    <li>Menjalankan manajemen mutu berbasis transparansi dan akuntabilitas.</li>
  </ol>

    <h2 style="text-align: center;">Staff Departemen Hasil Hutan</h2>

    <!-- Tabs -->
    <div class="sej-tabs">
      <button class="sej-tab-button active" data-tab="sej-struktur">Struktur Organisasi</button>
      <button class="sej-tab-button" data-tab="sej-dosen">Tenaga Pendidik/Dosen</button>
      <button class="sej-tab-button" data-tab="sej-kependidikan">Tenaga Kependidikan</button>
    </div>

    <!-- Tab Contents -->
    <div id="sej-struktur" class="sej-tab-content active">
      <div class="sej-card-grid"> <!-- baris satu -->
        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>
      </div>

      <div class="sej-card-grid"> <!-- baris dua -->
        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/buistie.jpg" alt="Ketua">
          <h4>Dr. Istie S. Rahayu</h4>
          <p>Ketua DHH / Ketua PS S1</p>
        </div>
      </div>
    </div>

    <div id="sej-dosen" class="sej-tab-content">
      <div class="sej-card-grid">
        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Dosen 1">
          <h4>Dr. Mahdi Mubarok</h4>
          <p>Komisi Kemahasiswaan</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Dosen 1">
          <h4>Dr. Mahdi Mubarok</h4>
          <p>Komisi Kemahasiswaan</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Dosen 1">
          <h4>Dr. Mahdi Mubarok</h4>
          <p>Komisi Kemahasiswaan</p>
        </div>

        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Dosen 1">
          <h4>Dr. Mahdi Mubarok</h4>
          <p>Komisi Kemahasiswaan</p>
        </div>
      </div>
    </div>

    <div id="sej-kependidikan" class="sej-tab-content">
      <div class="sej-card-grid">
        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Staf">
          <h4>Prof. Dr. I. Wayan Darmawan</h4>
          <p>Kepala PS S2/S3</p>
        </div>
        
        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Staf">
          <h4>Prof. Dr. I. Wayan Darmawan</h4>
          <p>Kepala PS S2/S3</p>
        </div>
        
        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Staf">
          <h4>Prof. Dr. I. Wayan Darmawan</h4>
          <p>Kepala PS S2/S3</p>
        </div>
        
        <div class="sej-staff-card">
          <img src="img/pairsan.jpg" alt="Staf">
          <h4>Prof. Dr. I. Wayan Darmawan</h4>
          <p>Kepala PS S2/S3</p>
        </div>
      </div>
    </div>
  </section>

  <script>
    const buttons = document.querySelectorAll('.sej-tab-button');
    const contents = document.querySelectorAll('.sej-tab-content');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => b.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));

        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');
      });
    });
  </script>
  </div>
</div>
@endsection
