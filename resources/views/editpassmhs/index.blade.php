@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
<div class="main-container">
  <aside class="sidebar">
    <a href="" class="menu-image-only">
      <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
    </a>
    <!-- Untuk aktifin button sub menu ========================= -->
    @php
      $isBerandaActive = Request::is('dashboardmhs');
      $isFormulirLayananActive = Request::is('formulirlayananakademikmhs');
      $isTingkatAkhirActive = Request::is('kolokiummhs') || Request::is('syaratkolokiummhs') || Request::is('seminarmhs') || Request::is('syaratseminarmhs') || Request::is('komprehensifmhs') || Request::is('syaratkomprehensifmhs');
      $isProfileMahasiswaActive = Request::is('profilemhs') || Request::is('user/*/edit') || Request::is('profilemhs/edit') || Request::is('editpassmhs*');
      $isLogoutmhsActive = Request::is('logoutmhs');
      @endphp

    <!-- BTN BERANDA ===================== -->
    <a href="/dashboardmhs" class="menu {{ $isBerandaActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-house-door-fill"></i>
        <span> Beranda </span>
      </div>
    </a>   

    <!-- BTN TINGKAT AKHIR ===================== -->
    <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="staffdept">
      <div class="menu-left">
        <i class="bi bi-mortarboard"></i>
        <span> Mahasiswa Tingkat Akhir </span>
      </div>
      <span class="dropdownArrow" data-arrow="staffdept">
        {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="staffdept"
      style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/kolokiummhs"
        class="submenu-link {{ Request::is('kolokiummhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Kolokium
      </a>
      <a href="/syaratkolokiummhs"
        class="submenu-link {{ Request::is('syaratkolokiummhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-info-circle"></i> Syarat Kolokium
      </a>
      <a href="/seminarmhs"
        class="submenu-link {{ Request::is('seminarmhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Seminar
      </a>
      <a href="/syaratseminarmhs"
        class="submenu-link {{ Request::is('syaratseminarmhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-info-circle"></i> Syarat Seminar
      </a>
      <a href="/komprehensifmhs"
        class="submenu-link {{ Request::is('komprehensifmhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-journal-text"></i> Komprehensif
      </a>
      <a href="/syaratkomprehensifmhs"
        class="submenu-link {{ Request::is('syaratkomprehensifmhs') ? 'active-submenu' : '' }}">
        <i class="bi bi-info-circle"></i> Syarat Komprehensif
      </a>
    </div>
  
    <!-- PEMBATAS EMAS ===================== -->
    <a href="" class="menu-image-only">
      <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
    </a>


    <!-- BTN Profile MHS ===================== -->
    <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profilemhs">
      <div class="menu-left">
        <i class="bi bi-person"></i>
        <span> Profil Mahasiswa </span>
      </div>
      <span class="dropdownArrow" data-arrow="profilemhs">
        {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="profilemhs"
      style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/profilemhs"
        class="submenu-link {{ Request::is('profilemhs', 'profilemhs/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-person-workspace"></i> Biodata Mahasiswa
      </a>
      <a href="/editpassmhs"
        class="submenu-link {{ Request::is('editpassmhs*') ? 'active-submenu' : '' }}">
        <i class="bi bi-gear-wide-connected"></i> Edit Password
      </a>
    </div>

    <!-- BTN LOGOUT ===================== -->
    <form action="{{ route('login.logout') }}" method="POST" class="menu p-0 m-0">
      @csrf
      <button type="submit" class="menu w-100 text-start border-0 bg-transparent">
        <div class="menu-left">
          <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
        </div>
      </button>
    </form>      
  </aside>

  <!-- MAIN KONTEN -->
  <main class="content">
    <div class="container-fluid mt-4">
      <h2 class="page-title">Edit Password Akun</h2>
    </div> 
    <div class="d-flex justify-content-center align-items-center w-100 mt-4">
      <div class="card p-4 shadow-sm w-75 border-2" style="border:solid #1b2a6d">
        <form method="POST" action="{{ route('editpassmhs.update') }}">
          @csrf

          {{-- Alert Success --}}
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
          @endif

          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">         
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach           
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>       
              </div>
          @endif

          <div class="text-start mb-4">
              <label class="form-label fw-bold mb-0">Password Saat Ini</label>
              <input type="password" name="current_password" class="form-control" style="background-color:#f5f5f5" placeholder="Masukkan password saat ini" required>
          </div>

          <div class="text-start mb-4">
              <label class="form-label fw-bold mb-0">Password Baru</label>
              <input type="password" name="new_password" class="form-control" style="background-color:#f5f5f5" placeholder="Masukkan password baru" required>
          </div>

          <div class="text-start mb-4">
              <label class="form-label fw-bold mb-0">Konfirmasi Password Baru</label>
              <input type="password" name="new_password_confirmation" class="form-control" style="background-color:#f5f5f5" placeholder="Konfirmasi password baru" required>
          </div>  

          <div class="row mt-4">
              <div class="mb-3 d-flex justify-content-between align-items-center">
                  <a href="{{ route('admprofile.index') }}" class="btn btn-secondary text-decoration-none">Kembali</a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </main>
@push('script')
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
@endpush
@endsection