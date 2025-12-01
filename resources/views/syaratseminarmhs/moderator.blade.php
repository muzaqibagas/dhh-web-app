
@extends('layouts.apps')

@section('content')
<div class="main-container">
  <aside class="sidebar">
    <a href="" class="menu-image-only">
      <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
    </a>
    <!-- Untuk aktifin button sub menu ========================= -->
    @php
      $isDashboardActive = Request::is('dashboardadm');
      
      $isRecapdataActive = Request::is('recapdata*');

      $isAdminProfileActive = Request::is('admprofile') || Request::is('user/*/edit') || Request::is('editpassadm') || Request::is('logoutadmprofile');

      
      $isTingkatAkhirActive = 
        Request::is('syaratkolokiummhs') || Request::is('syaratkolokiummhs*') ||
        Request::is('syaratseminarmhs') || Request::is('syaratseminarmhs*') ||
        Request::is('syaratkomprehensifmhs') || Request::is('syaratkomprehensifmhs*');

      $isKontenActive = 
          Request::is('kategorigaleri*') ||
          Request::is('galeri*') ||
          Request::is('kategoriartikel*') ||
          Request::is('artikel*') ||
          Request::is('review-alumni*') ||
          Request::is('konten-dept*') ||
          Request::is('kontenjenjang*') ||
          Request::is('mitra*');

      $isStaffDeptActive = 
          Request::is('kategoristaff*') ||
          Request::is('staff-dept*') ||
          Request::is('ketuadhh*');
    @endphp

    <!-- BTN Dashboard ===================== -->
    <a href="/dashboardadm" class="menu {{ $isDashboardActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-graph-up"></i> <span> Dashboard </span>
      </div>
      <span class="dropdownArrow"></span>
    </a>

    <!-- BTN RECAP DATA ===================== -->
    <a href="/recapdata" class="menu {{ $isRecapdataActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-database-check"></i> <span> Recap Data </span>
      </div>
      <span class="dropdownArrow"></span>
    </a>

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
      <a href="/syaratkolokiummhs"
        class="submenu-link {{ Request::is('syaratkolokiummhs', 'syaratkolokiummhs/*') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
      </a>
      <a href="/syaratseminarmhs"
        class="submenu-link {{ Request::is('syaratseminarmhs', 'syaratseminarmhs/*') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
      </a>
      <a href="/syaratkomprehensifmhs"
        class="submenu-link {{ Request::is('syaratkomprehensifmhs') ? 'active-submenu' : '' }}">
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
        class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit', 'konten-dept/create') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit', 'kontenjenjang/create') ? 'active-submenu' : '' }}">
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
    <a href="#" class="menu {{ $isAdminProfileActive ? 'active' : '' }}" data-dropdown="admprofile">
      <div class="menu-left">
        <i class="bi bi-person-badge"></i>
        <span> Profil Admin </span>
      </div>
      <span class="dropdownArrow" data-arrow="admprofile">
        {!! $isAdminProfileActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="admprofile"
      style="margin-left:24px; flex-direction:column; {{ $isAdminProfileActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/admprofile"
        class="submenu-link {{ Request::is('admprofile', 'user/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-person-workspace"></i> Detail Profil Admin
      </a>
      <a href="/editpassadm"
        class="submenu-link {{ Request::is('editpassadm') ? 'active-submenu' : '' }}">
        <i class="bi bi-gear-wide-connected"></i> Edit Password
      </a>
      <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
          @csrf
          <button type="submit" class="submenu-link w-100 text-start{{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
              <i class="bi bi-box-arrow-right"></i> Log Out
          </button>
      </form>
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

    <main class="content">        
        <div class="container-fluid mt-4">        
            <div class="adm-header">
                <h2 class="adm-title">Preview PDF Seminar Ditandatangani</h2>
            </div>
            {{-- Alert Success --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">                
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif
            {{-- Alert Error --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
            @endif     
            {{-- Alert Info --}}
            @if(session('info'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                {{ session('info') }}
            </div>
            @endif    
            <div class="card shadow-sm">                   
                <div class="card-body bg-light">
                    <strong class=" d-block mb-3 ">Formulir Tambah Dosen Moderator</strong>                     
                    <div class="ratio ratio-16x9 mb-3" style="min-height:350px;">
                        @if(strtolower($ext) === 'pdf')
                            <iframe src="{{ asset($formulirPath) }}" 
                                    style="border-radius:8px; border:1px solid #ddd; min-height:350px;" 
                                    allowfullscreen>
                            </iframe>                        
                        @endif
                    </div>

                    <form action="{{ route('syaratseminarmhs.tambahModerator' , $syaratSeminarmhs->id) }}" method="POST" class="row g-3">                                                                
                        @csrf
                        <input type="hidden" name="nim" value="{{ $nim }}">                           
                        <div class="d-flex flex-column gap-3">    
                            <div class="col-12 col-md-8 d-flex align-items-center">
                                <label for="moderator" class="form-label mb-0 w-50">Nama Dosen Moderator</label>:
                                <select name="moderator" id="moderator" class="form-control" required>
                                    <option value="">-- Pilih Moderator --</option>
                                    @foreach($listModerator as $dosen)
                                        <option value="{{ $dosen->id }}" 
                                            {{ $syaratSeminarmhs->id_moderator == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-8 d-flex align-items-center">
                                <label for="penandatanganundangan" class="form-label mb-0 w-50">Nama Penandatangan Undangan</label>:
                                <select name="penandatanganundangan" id="penandatanganundangan" class="form-control" required>
                                    <option value="">-- Pilih Penandatangan Undangan --</option>
                                    @foreach($listModerator as $dosen)
                                        <option value="{{ $dosen->id }}" 
                                            {{ $syaratSeminarmhs->id_penandatanganundangan == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Button di bawah kanan -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>                    
        </div>        
    </main>
</div>
@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
  $(document).ready(function () {
    $('#moderator').select2({
      width: '100%',
      placeholder: "Pilih Moderator",
      allowClear: true,
    });
  });

  // Select2 untuk pilihan Penandatangan Undangan
  $('#penandatanganundangan').select2({
    width: '100%',
    placeholder: "Pilih Penandatangan Undangan",   
    allowClear: true, 
  });
  </script>
@endpush
@endsection