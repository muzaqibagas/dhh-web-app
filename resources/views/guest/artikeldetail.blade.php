@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Detail Artikel</span>
</div>

<section class="guest-artikel-detail-section container my-5">
  <div class="row">
    <!-- Konten Artikel -->
    <div class="col-lg-8 col-md-12">
      <h1 class="guest-artikel-detail-title">
        Dua Mahasiswa IPB University Berjaya di Pemilihan Mahasiswa Berprestasi Nasional 2023
      </h1>      
      <p class="guest-artikel-detail-meta">
        Fahutan, Teknologi Hasil Hutan &nbsp; | &nbsp; Juli 24, 2025
      </p>          

      <div class="guest-artikel-detail-image mb-4">
        <img src="img/bglogin.jpg" alt="Detail Artikel">
        <span class="guest-artikel-detail-tag">SDGS Goals 12</span>
      </div>

      <div class="guest-artikel-detail-content">
        <p>
          IPB University kembali mencatat prestasi gemilang. Dua mahasiswa IPB University dari Sekolah Vokasi 
          dan Program Sarjana mengukir prestasi atas raihannya di acara puncak ‘Pemilihan Mahasiswa 
          Berprestasi (Pilmapres)’ Tahun 2023. Pemilihan tersebut berlangsung dari tanggal 24 hingga 27 Juli 2023 
          di Universitas Hasanudin, Makassar, Sulawesi Selatan.
        </p>
        <p>
          Volika Sinci Sari, mahasiswa IPB University dari Program Studi Komunikasi Digital Sekolah Vokasi 
          meraih gelar Mahasiswa Berprestasi Terbaik I Program Diploma Tingkat Nasional dan Honorable 
          Mention Penginspirasi Kepedulian. Sementara Azzahra Putri Santi, mahasiswa Departemen Hasil Hutan, 
          Fakultas Kehutanan dan Lingkungan IPB University didaulat sebagai Mahasiswa Berprestasi Harapan 3 
          Program Sarjana Tingkat Nasional.
        </p>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4 col-md-12">
      <!-- Search -->
      <input type="text" class="guest-artikel-detail-search" placeholder="Cari artikel...">

      <!-- Kategori -->
      <div class="guest-artikel-detail-sidebar">
        <h4 class="guest-artikel-detail-sidebar-title">Kategori Artikel</h4>
        <ul class="guest-artikel-detail-categories">
          <li>Akademik</li>
          <li>Berita</li>
          <li>Prestasi Civitas</li>
          <li>Sustainable Development Goals (SDG's)</li>
          <li>Karir</li>
        </ul>
      </div>

      <!-- Berita Terkini -->
      <div class="guest-artikel-detail-sidebar">
        <h4 class="guest-artikel-detail-sidebar-title">Berita Terkini</h4>
        <ul class="guest-artikel-detail-latest">
          <li>
            <a href="#">Diponegoro Social Political Competition penyelenggara BEM Fisip Universitas Diponegoro (Juara 3)</a>
            <span class="date">Juli 23, 2025</span>
          </li>
          <li>
            <a href="#">Asia Pacific Forestry Commission penyelenggara International Forestry Students Association</a>
            <span class="date">Juli 9, 2025</span>
          </li>
          <li>
            <a href="#">The 45th International Forestry Students Symposium tanggal 2-17 Juli 2025 di Afrika Selatan</a>
            <span class="date">Juli 9, 2025</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

@endsection
