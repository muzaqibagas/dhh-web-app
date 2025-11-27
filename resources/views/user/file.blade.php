@extends('layouts.app')

@section('content')

    <!-- ======= Breadcrumb ======= -->
    <div class="guest-breadcrumb">
      <a href="#">Home</a> / <span>Layanan Akademik</span>
    </div>
<body>
  
  <h3 class="guest-pend-section-title"></h3>
  <!-- Header -->
    <div class="judul-tengah">
      <h3 class="judul-tengah-title">Layanan Akademik</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider" class="judul-tengah-divider">
    </div>

    
  <!-- Card Section -->
  <div class="container guest-dc-footer-space">
    <div class="row g-4">

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-journal-text"></i> Rekomendasi Penelitian</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-mortarboard"></i> Pembuatan Surat Keterangan Lulus</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-files"></i> Distribusi Skripsi-1</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-check2-square"></i> Tanda Terima Proposal Penelitian</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-headset"></i> Pelayanan Akademik</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-envelope"></i> Surat Tunjangan Orang Tua</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-md-6">
        <div class="card guest-dc-card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span><i class="bi bi-emoji-frown"></i> Surat Izin Sakit</span>
            <a href="#" class="btn btn-primary btn-sm">Unduh</a>
          </div>
        </div>
      </div>
</div>
  </div>
  

@endsection

