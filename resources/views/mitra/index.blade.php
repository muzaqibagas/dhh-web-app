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
        $isStaffDeptActive = Request::is('kategoristaff-dept') || Request::is('staff-dept') || Request::is('ketuadhh');
        $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
        $isKontenActive = Request::is('kategorigaleri') || Request::is('galeri') || Request::is('kategoriartikel') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept') || Request::is('kontenjenjang') || Request::is('mitra');
      @endphp

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
        <a href="/kategorigaleri"
          class="submenu-link {{ Request::is('kategorigaleri') ? 'active-submenu' : '' }}">
          <i class="bi bi-clipboard-check"></i> Kategori Galeri
        </a>
        <a href="/galeri"
          class="submenu-link {{ Request::is('galeri') ? 'active-submenu' : '' }}">
          <i class="bi bi-images"></i> Galeri
        </a>
        <a href="/kategoriartikel"
          class="submenu-link {{ Request::is('kategoriartikel') ? 'active-submenu' : '' }}">
          <i class="bi bi-clipboard-check"></i> Kategori Artikel
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
        <a href="/kontenjenjang"
          class="submenu-link {{ Request::is('kontenjenjang') ? 'active-submenu' : '' }}">
          <i class="bi bi-house-door"></i> Konten Jenjang
        </a>
        <a href="/mitra"
          class="submenu-link {{ Request::is('mitra') ? 'active-submenu' : '' }}">
          <i class="bi bi-person-check"></i> Mitra
        </a>
      </div>

      <!-- BTN SDM ===================== -->
      <a href="#" class="menu {{ $isStaffDeptActive ? 'active' : '' }}" data-dropdown="staffdept">
        <div class="menu-left">
          <i class="bi bi-people-fill"></i>
          <span> Sumber Daya Manusia </span>
        </div>
        <span class="dropdownArrow" data-arrow="staffdept">
          {!! $isStaffDeptActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="staffdept"
        style="margin-left:24px; flex-direction:column; {{ $isStaffDeptActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/kategoristaff-dept"
          class="submenu-link {{ Request::is('kategoristaff-dept') ? 'active-submenu' : '' }}">
          <i class="bi bi-envelope-open"></i> Kategori Staff Departemen
        </a>
        <a href="/staffdept"
          class="submenu-link {{ Request::is('staff-dept') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Staff Departemen
        </a>
        <a href="/ketuadhh"
          class="submenu-link {{ Request::is('ketuadhh') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Ketua DHH
        </a>
      </div>
      
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

<!-- DAFTAR MITRA -->
 <main class="content">
<div class="container-fluid mt-4">
    <div class="adm-header">
        <h2 class="adm-title">Daftar Mitra</h2>
        <button class="adm-btn-add">
            <i class="bi bi-plus"></i> Tambah Data
        </button>
    </div> 
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light ">
                        <tr>
                            <th style="width: 10%;">No.</th>
                            <th style="width: 65%;">Nama Mitra</th>
                            <th style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Galeri (dummy) -->
                        <tr>
                            <td>1</td>
                            <td class="text-start">Universitas de Lorraine</td>
                            <td>
                            <button class="btn btn-success btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-pencil" style="font-size: 18px;"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-trash" style="font-size: 18px;"></i>
                            </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="text-start">Tokyo university</td>
                            <!-- Tombol Aksi -->
                        <td class="text-center">
                            <div style="display: flex; justify-content: center; gap: 6px;">
                                <button class="btn btn-success btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                    <i class="bi bi-pencil" style="font-size: 18px;"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                    <i class="bi bi-trash" style="font-size: 18px;"></i>
                                </button>
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection