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
        $isStaffDeptActive = Request::is('kategoristaff') || Request::is('staff-dept') || Request::is('ketuadhh');
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
        <a href="/kategoristaff"
          class="submenu-link {{ Request::is('kategoristaff') ? 'active-submenu' : '' }}">
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

<!-- KONTEN DEPARTEMEN -->
<main class="content">
<div class="container-fluid mt-4">
    <div class="adm-header">
        <h2 class="adm-title">Konten Departemen</h2>
    </div> 
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">

            <form>
                <!-- Sejarah -->
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold text-start">Sejarah</label>
                    <div class="col-sm-10">
                        <textarea rows="4" class="form-control" readonly>
Departemen Hasil Hutan (DHH) yang sebelumnya bernama Departemen Teknologi Hasil Hutan berdiri pada tahun 1969. DHH adalah Departemen Hasil Hutan tertua di Indonesia dan memiliki fokus pada pengembangan bidang keilmuan dan teknologi hasil hutan yang mencakup kimia hasil hutan, biokomposit, teknologi peningkatan kualitas kayu, dan desain dan keteknikan struktur kayu.
                        </textarea>
                    </div>
                </div>

                <!-- Visi -->
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold text-start">Visi</label>
                    <div class="col-sm-10">
                        <textarea rows="3" class="form-control" readonly>
Menjadi lembaga pendidikan tinggi bertaraf internasional dalam menghasilkan SDM bermutu dan mengembangkan IPTEKS di bidang teknologi pemanfaatan hasil hutan.
                        </textarea>
                    </div>
                </div>

                <!-- Misi -->
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold text-start">Misi</label>
                    <div class="col-sm-10">
                        <textarea rows="3" class="form-control" readonly>
Menyelenggarakan program tri dharma untuk menghasilkan sumberdaya manusia berkualifikasi sarjana dengan kompetensi utama teknologi hasil hutan dan mengembangkan inovasi IPTEKS untuk berkontribusi terhadap peningkatan produktifitas dan efisiensi industri hasil hutan.
                        </textarea>
                    </div>
                </div>

                <!-- Tujuan -->
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold text-start">Tujuan</label>
                    <div class="col-sm-10">
                        <textarea rows="6" class="form-control" readonly>
1. Mengoptimalkan pengembangan kapasitas sumberdaya melalui kerjasama di bidang pendidikan, penelitian, dan publikasi ilmiah terakreditasi baik nasional maupun internasional.
2. Mengoptimalkan pemberdayaan IPTEKS pemanfaatan hasil hutan melalui pengajaran, penelitian, publikasi, serta pelayanan pada masyarakat, yang dapat meningkatkan mutu departemen.
3. Mewujudkan manajemen pengelolaan sumberdaya departemen yang bermutu, profesional dan terbuka dalam pelaksanaan Tri Dharma Perguruan Tinggi yang bermanfaat bagi kesejahteraan di lingkungan DHHT dan masyarakat.
4. Menghasilkan lulusan PS THH yang mempunyai dasar ketrampilan, kemampuan analisis dan sintesis yang andal, serta profesionalisme dan kemandirian yang kuat pada bidang ilmu dan teknologi hasil hutan, dan berjiwa kewirausahaan.
                        </textarea>
                    </div>
                </div>

                <!-- Kebijakan Mutu -->
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold text-start">Kebijakan Mutu</label>
                    <div class="col-sm-10">
                        <textarea rows="5" class="form-control" readonly>
Untuk mendukung pengembangan IPB sebagai perguruan tinggi yang memiliki daya saing tinggi dan berkompetisi secara sehat dengan perguruan tinggi lainnya di dunia untuk menjadi perguruan tinggi berskala internasional, kebijakan mutu DHHT mengacu pada kebijakan mutu Fakultas Kehutanan, yaitu:
                        </textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Tombol -->
<div>
  <div class="row">
    <div class="mb-3 d-flex justify-content-end">
      <button type="button" class="btn btn-success">Edit</button>
    </div>
  </div>
</div>


@endsection