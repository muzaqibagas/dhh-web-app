@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan S3</span>
</div>

<section class="guest-galery-section">
  <!-- Video Utama -->
  <div class="guest-galery-video">
    <iframe width="100%" height="500" src="https://youtu.be/evNrI0f0QiA?si=nEfxiCCBwPUWNdvc" 
      title="Video Profile DHH 2023" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>

    <!-- Video Lainnya -->
    <h3 class="guest-pend-section-title">Video Lainnya</h3>
    <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
    <div class="guest-galery-videos">
    <div class="guest-galery-video-card">
        <iframe width="100%" height="200"
        src="https://youtu.be/4fndeDfaWCg?si=DHLnwUgAMo0KYBmd"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
        </iframe>
    </div>
    <div class="guest-galery-video-card">
        <iframe width="100%" height="200"
        src="https://youtu.be/4fndeDfaWCg?si=DHLnwUgAMo0KYBmd"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
        </iframe>
    </div>
    <div class="guest-galery-video-card">
        <iframe width="100%" height="200"
        src="https://youtu.be/4fndeDfaWCg?si=DHLnwUgAMo0KYBmd"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
        </iframe>
    </div>
    </div>


  <!-- Gallery -->
  <h2 class="guest-galery-title">Gallery</h2>
  <p class="guest-galery-desc">
    Sebagaimana hutan menyimpan jejak kehidupan, galeri ini menyimpan jejak langkah kami dalam berkegiatan, belajar, dan tumbuh bersama.
  </p>

    <!-- Filter -->
    <ul class="guest-galery-filters">
      <li class="guest-galery-filter active" data-filter="all">Semua</li>
      <li class="guest-galery-filter" data-filter="akademik">Akademik</li>
      <li class="guest-galery-filter" data-filter="sdgs">SDGS</li>
      <li class="guest-galery-filter" data-filter="prestasi">Prestasi</li>
      <li class="guest-galery-filter" data-filter="fasilitas">Fasilitas</li>
      <li class="guest-galery-filter" data-filter="kegiatan">Kegiatan</li>
    </ul>

    <!-- Grid Foto -->
    <div class="guest-galery-grid guest-galery-grid-5">

    <div class="guest-galery-item" data-category="akademik">
        <img src="img/bglogin.jpg" alt="Akademik">
    </div>
    <div class="guest-galery-item" data-category="sdgs">
        <img src="img/bglogin.jpg" alt="SDGS">
    </div>
    <div class="guest-galery-item" data-category="prestasi">
        <img src="img/bglogin.jpg" alt="Prestasi">
    </div>
    <div class="guest-galery-item" data-category="fasilitas">
        <img src="img/bglogin.jpg" alt="Fasilitas">
    </div>
    <div class="guest-galery-item" data-category="kegiatan">
        <img src="img/bglogin.jpg" alt="Kegiatan">
    </div>
    <div class="guest-galery-item" data-category="akademik">
        <img src="img/bglogin.jpg" alt="Akademik">
    </div>
        <div class="guest-galery-item" data-category="kegiatan">
        <img src="img/bglogin.jpg" alt="Kegiatan">
    </div>
    <div class="guest-galery-item" data-category="akademik">
        <img src="img/bglogin.jpg" alt="Akademik">
    </div>
    <div class="guest-galery-item" data-category="akademik">
        <img src="img/bglogin.jpg" alt="Akademik">
    </div>
    <div class="guest-galery-item" data-category="akademik">
        <img src="img/bglogin.jpg" alt="Akademik">
    </div>
    </div>
</section>
<script>
  const filters = document.querySelectorAll(".guest-galery-filter");
  const items = document.querySelectorAll(".guest-galery-item");
  const grid = document.querySelector(".guest-galery-grid");

  filters.forEach(filter => {
    filter.addEventListener("click", () => {
      filters.forEach(f => f.classList.remove("active"));
      filter.classList.add("active");

      const category = filter.dataset.filter;

      // ubah layout grid
      if (category === "all") {
        grid.classList.remove("guest-galery-grid-3");
        grid.classList.add("guest-galery-grid-5");
      } else {
        grid.classList.remove("guest-galery-grid-5");
        grid.classList.add("guest-galery-grid-3");
      }

      // filter item
      items.forEach(item => {
        if (category === "all" || item.dataset.category === category) {
          item.classList.remove("hidden");
        } else {
          item.classList.add("hidden");
        }
      });
    });
  });

</script>

@endsection