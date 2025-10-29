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
      $isProfileMahasiswaActive = Request::is('profilemhs') || Request::is('user/*/edit') || Request::is('profilemhs/edit') || Request::is('editpassmhs');
      $isLogoutmhsActive = Request::is('logoutmhs');
      @endphp

    <!-- BTN BERANDA ===================== -->
    <a href="/dashboardmhs" class="menu {{ $isBerandaActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-house-door-fill"></i>
        <span> Beranda </span>
      </div>
    </a>

    <!-- BTN Layanan Akademik ===================== -->
    <a href="/formulirlayananakademikmhs" class="menu {{ $isFormulirLayananActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-file-earmark-text"></i>
        <span> Formulir Layanan Akademik </span>
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
        class="submenu-link {{ Request::is('editpassmhs') ? 'active-submenu' : '' }}">
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
  <main class="content">
    <h2 class="page-title">Biodata Mahasiswa</h2>
    <div class="id-card-container p-4 shadow-lg rounded-4 d-flex flex-row align-items-center w-100 mt-4" style="background: linear-gradient(135deg, #e0e7ff 60%, #f5f5f5 100%); border: 2px solid #1b2a6d; min-width: 420px;">
      <div class="id-photo text-center me-4">
        <div class="rounded-3 overflow-hidden border border-3 border-primary mx-auto" style="width: 200px; height: 300px; background:#fff; margin-bottom: 10px;">
          @if($user->foto)
            <img id="preview-image" src="{{ asset('profile/' . $user->foto) }}" alt="" class="w-100 h-100 object-fit-cover">
          @else
            <img id="preview-image" src="{{ asset('img/default.jpeg') }}" alt="" class="w-100 h-100 object-fit-cover">
          @endif
        </div>
        <a href="{{ route('profilemhs.edit') }}" class="btn btn-primary w-100"><i class="bi bi-pencil-square"></i> Edit Profile</a>
      </div>
      <div class="id-data flex-grow-1">
        <div class="mb-2">
          <label class="form-label fw-bold mb-0">Nama</label>
          <input type="text" class="form-control form-control-sm" value="{{ $user->nama ?? '-' }}" readonly style="background-color:#f5f5f5;">
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold mb-0">NIM</label>
          <input type="text" class="form-control form-control-sm" value="{{ $user->nim ?? '-' }}" readonly style="background-color:#f5f5f5;">
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold mb-0">No Handphone</label>
          <input type="text" class="form-control form-control-sm" value="{{ $user->no_hp ?? '-' }}" readonly style="background-color:#f5f5f5;">
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold mb-0">Email</label>
          <input type="text" class="form-control form-control-sm" value="{{ $user->email ?? '-' }}" readonly style="background-color:#f5f5f5;">
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold mb-0">Jenis Kelamin</label><br>
          <input type="text" class="form-control form-control-sm" value="{{ $user->jenis_kelamin ?? '-' }}" readonly style="background-color:#f5f5f5;">
        </div>
        <div class="signature-box w-50" 
            style="min-height:80px; max-height:100px; display:flex; align-items:center; justify-content:center; background:#fff; border:1.5px solid #1b2a6d; border-radius:6px;">                                         
          @if($user->tanda_tangan)
            <img src="{{ asset('signature/' . $user->tanda_tangan) }}" 
                alt="Tanda Tangan" 
                style="max-width: 100%; max-height: 100%; object-fit: contain; height: auto; width: auto;">
          @else
            <span style="color:#aaa;">Belum ada tanda tangan</span>
          @endif
        </div>
      </div>
    </div>    
  </main>
</div>
@push('style')
  <style>
    .id-card-container {
      box-shadow: 0 4px 24px 0 rgba(30, 41, 59, 0.10);
      border-radius: 18px;
      margin-top: 32px;
      margin-bottom: 32px;
    }
    .id-data label {
      color: #1b2a6d;
    }
    .id-data input, .id-data .form-check-input {
      font-size: 1em;
    }
    .signature-box {
      min-height: 60px;
      max-height: 90px;
      border: 1.5px dashed #1b2a6d;
    }
  </style>
@endpush
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
