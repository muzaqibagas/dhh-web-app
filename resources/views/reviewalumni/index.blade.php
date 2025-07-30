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
        $isAkademikActive = Request::is('kurikulum') || Request::is('mata-kuliah');
        $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
        $isKontenActive = Request::is('galeri') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept');
      @endphp

      <!-- BTN AKADEMIK========================= -->
      <a href="#" class="menu{{ $isAkademikActive ? 'active' : '' }}" data-dropdown="akademik">
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
      <a href="/staffdept" class="menu">
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
    
<!-- Halaman Galeri - Admin Dashboard -->
<main class="content">
<div class="container-fluid mt-4">
    <div class="adm-header">
        <h2 class="adm-title">Daftar Review Alumni</h2>
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
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Galeri (dummy) -->
                        <tr>
                            <td>1</td>
                            <td>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHrrqctH3nm0R5vu9AM69b--LaN02ueV2DdQ&s" 
                                    alt="foto" 
                                    class="img-thumbnail"
                                    style="max-width: 80px; max-height: 80px; object-fit: cover;">
                            </td>
                            <td>Nyanya Caine</td>
                            <td>59</td>
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
                            <td><img src="https://pbs.twimg.com/media/GoKuxoSasAE9xO9.jpg" 
                                    alt="foto" 
                                    class="img-thumbnail"
                                    style="max-width: 80px; max-height: 80px; object-fit: cover;">
                            </td>
                            <td>Mikazuki Bunny</td>
                            <td>60</td>
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
                        <!-- Tambahkan baris lain sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
