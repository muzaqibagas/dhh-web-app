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
      <a href="#" class="menu {{ $isAkademikActive ? 'active' : '' }}" data-dropdown="akademik">
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
      <a href="#" class="menu active {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="tingkatakhir">
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
  
<!-- MAIN CONTENT -->
  <main class="content">
    <div class="adm-header">
        <h2 class="adm-title">Data Pendaftar Kolokium</h2>
    </div>
    <div class="adm-card">
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Form Kolokium</th>
                    <th>Moderator</th>
                    <th>Bukti SPP</th>
                    <th>Kartu Kehadiran</th>
                    <th>Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $pendaftar = [
                        ['nama' => 'Raisa Mutia Thahir'],
                        ['nama' => 'Hasna Nabilah Widiani'],
                        ['nama' => 'Nurbadillah'],
                        ['nama' => 'Saniyyah Wafa Nurjihan'],
                    ];
                @endphp

                @foreach ($pendaftar as $p)
                <tr>
                    <td  class="text-start">{{ $p['nama'] }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                    </td>
                    <td>
                        <select class="form-select form-select-sm">
                            <option selected disabled>pilih mod</option>
                            <option>Moderator 1</option>
                            <option>Moderator 2</option>
                        </select>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm me-1">
                            <i class="bi bi-check-circle-fill"></i>
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
        
    

