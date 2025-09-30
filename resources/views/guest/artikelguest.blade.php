@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Artikel</span>
</div>

<section class="guest-artikel-detail-section container my-5">
  <div class="row">
<!-- Gallery -->
  <h2 class="guest-galery-title">Artikel</h2>
  <p class="guest-galery-desc">
    Artikel-artikel ini merupakan media untuk menyampaikan informasi, penelitian, serta pemikiran dari Departemen Hasil Hutan, yang diharapkan dapat memberikan kontribusi bagi ilmu pengetahuan dan masyarakat.
  </p>
    <div class="guest-artikel-layout">
      <!-- MAIN CONTENT -->
      <main class="guest-artikel-main">

        <!-- TOP: 3 FEATURED -->
        <div class="guest-artikel-featured-grid">
          <article class="guest-artikel-featured-card">
            <img src="img/bglogin.jpg" alt="featured 1">
            <div class="guest-artikel-featured-meta">
              <span class="guest-artikel-badge guest-artikel-badge--berita">Berita</span>
              <span class="guest-artikel-date">14 Apr 2025</span>
              <h3>Forest Products Department IPB dibanjiri banyak undangan</h3>
            </div>
          </article>

          <article class="guest-artikel-featured-card">
            <img src="img/bglogin.jpg" alt="featured 2">
            <div class="guest-artikel-featured-meta">
              <span class="guest-artikel-badge guest-artikel-badge--akademik">Akademik</span>
              <span class="guest-artikel-date">14 Apr 2025</span>
              <h3>Menghadiri berbagai seminar dan mengadakan seminar, DHH diberi pujian</h3>
            </div>
          </article>

          <article class="guest-artikel-featured-card">
            <img src="img/bglogin.jpg" alt="featured 3">
            <div class="guest-artikel-featured-meta">
              <span class="guest-artikel-badge guest-artikel-badge--prestasi">Prestasi</span>
              <span class="guest-artikel-date">14 Apr 2025</span>
              <h3>Departemen Hasil Hutan mendapatkan penghargaan sebagai departemen terbaik</h3>
            </div>
          </article>
        </div>

        <!-- MIDDLE: 3 COLUMNS OF LISTS -->
        <div class="guest-artikel-columns">
          <!-- Column 1 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--prestasi small">Prestasi</span>
                <h4>Departemen Hasil Hutan mendapatkan penghargaan sebagai departemen terbaik</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <!-- repeat items -->
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--akademik small">Akademik</span>
                <h4>DHH aktif menghadiri kegiatan seminar internasional</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <!-- add more list items as needed -->
          </div>

          <!-- Column 2 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--akademik small">Akademik</span>
                <h4>Berbagai kegiatan akademik dan pengabdian masyarakat</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--sdgs small">SDGS</span>
                <h4>Inisiatif SDGs: program konservasi dan penelitian</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Column 3 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--berita small">Berita</span>
                <h4>Informasi penting terkait kegiatan departemen</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--karir small">Karir</span>
                <h4>Peluang karir & beasiswa untuk mahasiswa</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="guest-artikel-bottom-grid">
            <div class="guest-artikel-bottom-card">
                <img src="img/bglogin.jpg" alt="">
                <div class="guest-artikel-bottom-body">
                <span class="guest-artikel-category">Akademik</span>
                <h4>DHH diberi pujian dalam seminar</h4>
                <div class="guest-artikel-bottom-meta">14 Apr 2025</div>
                </div>
            </div>

            <div class="guest-artikel-bottom-card">
                <img src="img/bglogin.jpg" alt="">
                <div class="guest-artikel-bottom-body">
                <span class="guest-artikel-category">Prestasi</span>
                <h4>Penghargaan departemen terbaik</h4>
                <div class="guest-artikel-bottom-meta">14 Apr 2025</div>
                </div>
            </div>

            <div class="guest-artikel-bottom-card">
                <img src="img/bglogin.jpg" alt="">
                <div class="guest-artikel-bottom-body">
                <span class="guest-artikel-category">Berita</span>
                <h4>Forest Products Department IPB dibanjiri undangan</h4>
                <div class="guest-artikel-bottom-meta">14 Apr 2025</div>
                </div>
            </div>
        </div>

        <!-- MIDDLE: 3 COLUMNS OF LISTS -->
        <div class="guest-artikel-columns">
          <!-- Column 1 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--prestasi small">Prestasi</span>
                <h4>Departemen Hasil Hutan mendapatkan penghargaan sebagai departemen terbaik</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <!-- repeat items -->
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--akademik small">Akademik</span>
                <h4>DHH aktif menghadiri kegiatan seminar internasional</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <!-- add more list items as needed -->
          </div>

          <!-- Column 2 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--akademik small">Akademik</span>
                <h4>Berbagai kegiatan akademik dan pengabdian masyarakat</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--sdgs small">SDGS</span>
                <h4>Inisiatif SDGs: program konservasi dan penelitian</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Column 3 -->
          <div class="guest-artikel-list-col">
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--berita small">Berita</span>
                <h4>Informasi penting terkait kegiatan departemen</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
            <div class="guest-artikel-list-item">
              <img src="img/bglogin.jpg" alt="">
              <div class="guest-artikel-list-body">
                <span class="guest-artikel-badge guest-artikel-badge--karir small">Karir</span>
                <h4>Peluang karir & beasiswa untuk mahasiswa</h4>
                <div class="guest-artikel-list-meta">
                  <span class="guest-artikel-date">14 Apr 2025</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

<!-- SIDEBAR -->
<aside class="guest-artikel-sidebar">

  <div class="guest-artikel-searchbox">
    <input type="text" placeholder="Cari artikel..." class="guest-artikel-search">
  </div>

  <!-- Dropdown Kategori Artikel -->
  <details class="guest-dropdown mobile-only">
    <summary>Kategori Artikel</summary>
    <ul class="guest-artikel-detail-categories">
      <li>Akademik</li>
      <li>Berita</li>
      <li>Prestasi Civitas</li>
      <li>Sustainable Development Goals (SDG's)</li>
      <li>Karir</li>
    </ul>
  </details>

  <!-- Sidebar versi desktop -->
  <div class="guest-artikel-detail-sidebar desktop-only">
    <h4 class="guest-artikel-detail-sidebar-title">Kategori Artikel</h4>
    <ul class="guest-artikel-detail-categories">
      <li>Akademik</li>
      <li>Berita</li>
      <li>Prestasi Civitas</li>
      <li>Sustainable Development Goals (SDG's)</li>
      <li>Karir</li>
    </ul>
  </div>

  <!-- Dropdown Berita Terkini -->
  <details class="guest-dropdown mobile-only">
    <summary>Berita Terkini</summary>
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
  </details>

  <!-- Sidebar versi desktop -->
  <div class="guest-artikel-detail-sidebar desktop-only">
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

</aside>

    </div> <!-- layout -->
  </div> <!-- container -->
</section>
@endsection