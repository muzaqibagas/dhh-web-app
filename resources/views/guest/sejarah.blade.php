@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>

<div class="container my-5">

  <!-- SEJARAH -->
  <h2 class="guest-pend-section-title">Sejarah</h2>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <p style="text-align: justify;">
    Departemen Hasil Hutan (DHH) yang sebelumnya bernama Departemen Teknologi Hasil Hutan berdiri pada tahun 1969.
    DHH adalah Departemen Hasil Hutan pertama di Indonesia dan memiliki fokus pada pengembangan bidang keilmuan
    dan teknologi hasil hutan yang mencakup kimia hasil hutan, biokomposit, teknologi peningkatan kualitas kayu,
    dan desain serta keteknikan struktur kayu.
  </p>

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

  <!-- STAFF -->
  <h2 class="guest-section-title text-center mt-5">Staff Departemen Hasil Hutan</h2>

  <!-- Tabs -->
  <ul class="nav nav-tabs justify-content-center guest-staff-tabs" id="guestStaffTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="guest-org-tab" data-bs-toggle="tab" data-bs-target="#guest-org" type="button" role="tab">
        Struktur Organisasi
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="guest-dosen-tab" data-bs-toggle="tab" data-bs-target="#guest-dosen" type="button" role="tab">
        Tenaga Pendidik/Dosen
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="guest-kependidikan-tab" data-bs-toggle="tab" data-bs-target="#guest-kependidikan" type="button" role="tab">
        Tenaga Kependidikan
      </button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content guest-staff-content mt-4" id="guestStaffTabContent">

    <!-- Struktur Organisasi -->
    <div class="tab-pane fade show active" id="guest-org" role="tabpanel">
      <div class="row g-4">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="guest-card text-center p-3">
            <img src="img/buistie.jpg" class="img-fluid guest-card-img" alt="Staff">
            <h5 class="guest-card-name mt-2">Dr. Isti S. Rahayu</h5>
            <p class="guest-card-role">Ketua DHH / Ketua PS S1</p>
          </div>
        </div>
        <!-- tambah card lainnya -->
      </div>
    </div>

    <!-- Dosen -->
    <div class="tab-pane fade" id="guest-dosen" role="tabpanel">
      <div class="row g-4">
        @for ($i = 0; $i < 4; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="guest-card text-center p-3">
            <img src="img/pairsan.jpg" class="img-fluid guest-card-img" alt="Dosen">
            <h5 class="guest-card-name mt-2">Dr. Irfan Alisaputra</h5>
            <p class="guest-card-role">Sekretaris DHH</p>
          </div>
        </div>
        @endfor
      </div>
    </div>

    <!-- Kependidikan -->
    <div class="tab-pane fade" id="guest-kependidikan" role="tabpanel">
      <div class="row g-4">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="guest-card text-center p-3">
            <img src="img/pairsan.jpg" class="img-fluid guest-card-img" alt="Kependidikan">
            <h5 class="guest-card-name mt-2">Prof. I Wayan Darmawan</h5>
            <p class="guest-card-role">Ketua PS S2 &amp; S3 ITHH</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
