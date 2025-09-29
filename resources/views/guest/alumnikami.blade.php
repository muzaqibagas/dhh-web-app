@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Alumnikami</span>
</div>
<div class="guest-carousel-alumni-container">
    <!-- SLIDES -->
    <div class="guest-carousel-alumni-slide guest-active">
        <img src="img/alumnikita.png" alt="Slide 1">
        <div class="guest-carousel-alumni-caption">
            <h2>Alumni Berprestasi</h2>
            <p>Para alumni Departemen Hasil Hutan berkiprah di berbagai bidang industri dan akademik.</p>
        </div>
    </div>
    <div class="guest-carousel-alumni-slide">
        <img src="img/slide2.jpg" alt="Slide 2">
        <div class="guest-carousel-alumni-caption">
            <h2>Kontribusi Alumni</h2>
            <p>Banyak alumni yang mendukung pengembangan hutan berkelanjutan melalui riset dan inovasi.</p>
        </div>
    </div>

    <!-- BUTTONS -->
    <button class="guest-carousel-alumni-prev">&#10094;</button>
    <button class="guest-carousel-alumni-next">&#10095;</button>
</div>
<section class="guest-artikel-detail-section container my-5">
  <div class="row">
<!-- Gallery -->
  <h2 class="guest-galery-title">Alumni Kami</h2>
  <p class="guest-galery-desc">
    Profil alumni ini menjadi pengingat bahwa keberhasilan hadir dalam banyak bentuk, dengan satu semangat yang sama: berkembang dan memberi makna.
  </p>

  <div class="guest-alumni-grid">
    <!-- Card 1 -->
    <div class="guest-alumni-card">
      <img src="img/buistie.jpg" alt="Alumni 1">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

    <!-- Card 2 -->
    <div class="guest-alumni-card">
      <img src="img/bglogin.jpg" alt="Alumni 2">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

    <!-- Card 3 -->
    <div class="guest-alumni-card">
      <img src="img/bglogin.jpg" alt="Alumni 3">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

    <!-- Card 4 -->
    <div class="guest-alumni-card">
      <img src="img/bglogin.jpg" alt="Alumni 4">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

        <!-- Card 4 -->
    <div class="guest-alumni-card">
      <img src="img/bglogin.jpg" alt="Alumni 4">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

        <!-- Card 4 -->
    <div class="guest-alumni-card">
      <img src="img/bglogin.jpg" alt="Alumni 4">
      <h5>Anggityo Bagyas</h5>
      <p>Selamat atas pelantikan Dr. ...</p>
    </div>

    <!-- Tambahkan card lainnya sesuai kebutuhan -->
  </div>
</section>
@endsection
