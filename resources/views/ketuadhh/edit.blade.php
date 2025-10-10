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
      $isTingkatAkhirActive = 
        Request::is('undangan') || Request::is('undangankolokium') || Request::is('undanganseminar') || Request::is('undangansidang') || 
        Request::is('kolokium') || 
        Request::is('seminar') || 
        Request::is('sidang');
      $isKontenActive = 
        Request::is('kategorigaleri') || Request::is('kategorigaleri/create') || Request::is('kategorigaleri/*/edit') || 
        Request::is('galeri') || Request::is('galeri/create') || Request::is('galeri/*/edit') || 
        Request::is('kategoriartikel') || Request::is('kategoriartikel/create') || Request::is('kategoriartikel/*/edit') || 
        Request::is('artikel') || Request::is('artikel/create') || Request::is('artikel/*/edit') || 
        Request::is('review-alumni') || Request::is('review-alumni/create') || Request::is('review-alumni/*/edit') |
        Request::is('konten-dept') || Request::is('konten-dept/show') || Request::is('konten-dept/*/edit') || 
        Request::is('kontenjenjang') || Request::is('kontenjenjang/show') || Request::is('kontenjenjang/*/edit') || 
        Request::is('mitra'); Request::is('mitra/create') || Request::is('mitra/*/edit') || 
      $isStaffDeptActive = 
        Request::is('kategoristaff') || Request::is('kategoristaff/create') || Request::is('kategoristaff/*/edit') |
        Request::is('staff-dept') || Request::is('staff-dept/create') || Request::is('staff-dept/*/edit') |
        Request::is('ketuadhh') || Request::is('ketuadhh/create') || Request::is('ketuadhh/*/edit');
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
        class="submenu-link {{ Request::is('undangan', 'undangankolokium', 'undanganseminar', 'undangansidang') ? 'active-submenu' : '' }}">
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
        class="submenu-link {{ Request::is('kategorigaleri', 'kategorigaleri/create', 'kategorigaleri/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Galeri
      </a>
      <a href="/galeri"
        class="submenu-link {{ Request::is('galeri', 'galeri/create', 'galeri/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-images"></i> Galeri
      </a>
      <a href="/kategoriartikel"
        class="submenu-link {{ Request::is('kategoriartikel', 'kategoriartikel/create', 'kategoriartikel/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Artikel
      </a>
      <a href="/artikel"
        class="submenu-link {{ Request::is('artikel', 'artikel/create', 'artikel/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-layout-text-window"></i> Artikel
      </a>
      <a href="/review-alumni"
        class="submenu-link {{ Request::is('review-alumni', 'review-alumni/create', 'review-alumni/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-star"></i>  Review Alumni
      </a>
      <a href="/konten-dept"
        class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-house-door"></i> Konten Jenjang
      </a>
      <a href="/mitra"
        class="submenu-link {{ Request::is('mitra', 'mitra/create', 'mitra/*/edit') ? 'active-submenu' : '' }}">
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
      <a href="/kategoristaff"
        class="submenu-link {{ Request::is('kategoristaff', 'kategoristaff/create', 'kategoristaff/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-envelope-open"></i> Kategori Staff Departemen
      </a>
      <a href="/staff-dept"
        class="submenu-link {{ Request::is('staff-dept', 'staff-dept/create', 'staff-dept/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Staff Departemen
      </a>
      <a href="/ketuadhh"
        class="submenu-link {{ Request::is('ketuadhh', 'ketuadhh/create', 'ketuadhh/*/edit') ? 'active-submenu' : '' }}">
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

<!-- MAIN KONTEN -->
<main class="content">
<div class="container-fluid mt-4">
    <div class="adm-header">
        <h2 class="adm-title">Edit Pimpinan DHH</h2>
    </div> 
    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('info')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">

                <form action="{{ route('ketuadhh.update', $ketuaDHH->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- UPDATE DATA -->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                      <label for="nama" class="col-form-label">Nama</label>
                  </div>
                  <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $ketuaDHH->nama) }}" placeholder="Masukkan Nama Pimpinan" required>
                  </div>
                </div>

                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                    <label for="tahun_mulai" class="col-form-label">Masa Jabatan</label>
                  </div>
                  <div class="col-sm-10 d-flex align-items-center">
                    <select name="tahun_mulai" id="tahun_mulai" class="form-select me-2" required>
                      <option value="">Tahun mulai</option>
                      @for ($year = date('Y'); $year >= 1900; $year--)
                        <option value="{{ $year }}" 
                          {{ old('tahun_mulai', $ketuaDHH->tahun_mulai ?? '') == $year ? 'selected' : '' }}>
                          {{ $year }}
                        </option>
                      @endfor
                    </select>
                    <span class="mx-2">s/d</span>
                    <select name="tahun_selesai" id="tahun_selesai" class="form-select ms-2" required>
                      <option value="">Tahun selesai</option>
                      @for ($year = date('Y'); $year >= 1900; $year--)
                        <option value="{{ $year }}" 
                          {{ old('tahun_selesai', $ketuaDHH->tahun_selesai ?? '') == $year ? 'selected' : '' }}>
                          {{ $year }}
                        </option>
                      @endfor
                    </select>
                  </div>
                </div>
                <!-- pre-review foto pimpinan-->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                      <label for="foto" class="col-form-label">Foto</label>
                  </div>
                  <!-- input file -->
                <div class="col-sm-10">
                  <input type="file" name="foto" class="form-control" id="logo" accept="image/*">
                </div>
                <div class="d-flex justify-content-center mt-3 w-100">
                    <div id='prereview-container' class="border rounded bg-light d-flex align-items-center justify-content-center mb-2" style="height: 150px;">                    
                        <img id="preview-image" src="{{ $ketuaDHH->foto ? asset($ketuaDHH->foto) : '' }}" alt="Preview" class="img-fluid rounded @if(!$ketuaDHH->foto) d-none @endif" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                </div>
              </div>

                <!-- Tombol -->
                <div>
                <div class="row">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <a href="{{route('ketuadhh.index')}}" class="btn btn-secondary text-decoration-none">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
                </div>
          </form>
      </div>
  </div>
</div>
@endsection