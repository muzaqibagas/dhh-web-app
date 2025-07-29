@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
 <div class="main-container">
    <aside class="sidebar">
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- Untuk aktifin button sub menu ========================= -->
      @php
        $isAkademikActive = Request::is('kurikulum') || Request::is('mata-kuliah') || Request::is('kurikulum/1/edit');
        $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
        $isKontenActive = Request::is('galeri') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept') ; 
      @endphp

      <!-- BTN AKADEMIK========================= -->
      <a href="#" class="menu active {{ $isAkademikActive ? 'active' : '' }}" data-dropdown="akademik">
        <div class="menu-left">
          <i class="bi bi-journal-check"></i>
          <span> Akademik </span>
        </div>
        <span class="dropdownArrow" data-arrow="akademik">
          {!! $isAkademikActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="akademik"
        style="margin-left:24px; flex-direction:column; {{ $isAkademikActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/kurikulum"
          class="submenu-link {{ Request::is('kurikulum') ? 'active-submenu' : '' }}">
          <i class="bi bi-archive"></i> Daftar Kurikulum
        </a>
        <a href="/mata-kuliah"
          class="submenu-link {{ Request::is('mata-kuliah') ? 'active-submenu' : '' }}">
          <i class="bi bi-journals"></i> Mata Kuliah
        </a>
      </div>

      <!-- BTN TINGKAT AKHIR===================== -->
      <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="tingkatakhir">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span> Tingkat Akhir </span>
        </div>
        <span class="dropdownArrow" data-arrow="tingkatakhir">
          {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="tingkatakhir"
        style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/undangan"
          class="submenu-link {{ Request::is('undangan') ? 'active-submenu' : '' }}">
          <i class="bi bi-envelope-open"></i> Undangan
        </a>
        <a href="/kolokium"
          class="submenu-link {{ Request::is('kolokium') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
        </a>
        <a href="/seminar"
          class="submenu-link {{ Request::is('seminar') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
        </a>
        <a href="/sidang"
          class="submenu-link {{ Request::is('sidang') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Data Pendaftar Sidang
        </a>
      </div>

      <!-- BTN KONTEN ===================== -->
      <a href="#" class="menu {{ $isKontenActive ? 'active' : '' }}" data-dropdown="konten">
        <div class="menu-left">
          <i class="bi bi-collection"></i>
          <span> Konten </span>
        </div>
        <span class="dropdownArrow" data-arrow="konten">
          {!! $isKontenActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="konten"
        style="margin-left:24px; flex-direction:column; {{ $isKontenActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/galeri"
          class="submenu-link {{ Request::is('galeri') ? 'active-submenu' : '' }}">
          <i class="bi bi-images"></i> Galeri
        </a>
        <a href="/artikel"
          class="submenu-link {{ Request::is('artikel') ? 'active-submenu' : '' }}">
          <i class="bi bi-layout-text-window"></i> Artikel
        </a>
        <a href="/review-alumni"
          class="submenu-link {{ Request::is('review-alumni') ? 'active-submenu' : '' }}">
          <i class="bi bi-star"></i>  Review Alumni
        </a>
        <a href="/konten-dept"
          class="submenu-link {{ Request::is('konten-dept') ? 'active-submenu' : '' }}">
          <i class="bi bi-laptop"></i> Konten Departemen
        </a>
      </div>

      <!-- BTN SDM ===================== -->
      <a href="/admsumberdayamanusia" class="menu">
        <div class="menu-left">
          <i class="bi bi-people-fill"></i> <span> Sumber Daya Manusia </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      
      <!-- PEMBATAS EMAS ===================== -->
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>

      <!-- BTN ADMIN ===================== -->
      <a href="/admprofile" class="menu">
        <div class="menu-left">
          <i class="bi bi-person-badge"></i> <span> Profil Admin </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
    
      <script>
        document.querySelectorAll('[data-dropdown]').forEach(toggle => {
          toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const target = this.getAttribute('data-dropdown');
            const menu = document.querySelector(`[data-menu="${target}"]`);
            const arrow = document.querySelector(`[data-arrow="${target}"]`);
            const isOpen = menu.style.display === 'flex';

            // Tutup semua dulu
            document.querySelectorAll('[data-menu]').forEach(m => m.style.display = 'none');
            document.querySelectorAll('[data-arrow]').forEach(a => a.innerHTML = '&#9650;');

            // Kalau belum terbuka, buka
            if (!isOpen) {
              menu.style.display = 'flex';
              arrow.innerHTML = '&#9660;';
            }
          });
        });
      </script>
    </aside>

<div class="content my-4">
  <h2 class="page-title">Tambah Kurikulum</h2>
  <div class="card shadow-sm rounded-4">
    <div class="card-body">
      <form>

        <!-- Jenjang & Tahun -->
    <div class="row mb-3">
      <div class="col-md-2 fw-semibold text-start">Jenjang</div>
      <div class="col-md-4">
        <select class="form-select form-select-sm">
          <option>S1</option>
          <option>D3</option>
        </select>
      </div>
      <div class="col-md-2 fw-semibold text-start">Tahun</div>
      <div class="col-md-4">
        <select class="form-select form-select-sm">
          <option>2013</option>
          <option>2014</option>
        </select>
      </div>
    </div>

    <!-- Nama Kurikulum & Kompetensi -->
    <div class="row mb-3 align-items-center">
      <div class="col-md-2 fw-semibold text-start">Nama Kurikulum</div>
      <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" placeholder="Contoh: Kurikulum Berbasis Teknologi">
      </div>
      <div class="col-md-2 fw-semibold text-start">Kompetensi</div>
      <div class="col-md-4">
        <select class="form-select form-select-sm">
          <option>Kompetensi Mayor</option>
          <option>Kompetensi Minor</option>
        </select>
      </div>
    </div>

    <!-- Deskripsi -->
    <div class="row mb-3">
      <div class="col-md-2 fw-semibold text-start">Deskripsi</div>
      <div class="col-md-10">
        <textarea class="form-control form-control-sm" rows="4" placeholder="Masukkan deskripsi kurikulum..."></textarea>
      </div>
    </div>

    <!-- Tombol -->
    <div class="row">
      <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-success btn-sm me-2">
           Simpan
        </button>
        <a href="#" class="btn btn-danger btn-sm">
          Batal
        </a>
      </div>
    </div>

  </form>
</div>
</div>
@endsection