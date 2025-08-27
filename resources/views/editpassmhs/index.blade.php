@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
<div class="main-container">
  <aside class="sidebar">
    <a href="#" class="menu-image-only">
      <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
    </a>
    
    <a href="/dashboardmhs" class="menu ">
      <div class="menu-left">
        <i class="bi bi-house-door-fill"></i> <span> Beranda </span>
      </div>
    </a>
    <a href="/profilemhs" class="menu">
      <div class="menu-left">
        <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
      </div>
    </a>
    <a href="/formulirlayananakademikmhs" class="menu">
      <div class="menu-left">
        <i class="bi bi-file-earmark-text"></i> <span> Formulir Layanan Akademik </span>
      </div>
    </a>
    <!-- <a href="#" class="menu"><i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir</a> -->
    <a href="#" class="menu {{ request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? 'active' : '' }}" id="dropdownToggle">
        <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
        <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">
            {{-- kalau ada di salah satu submenu → panah kebuka ▼ --}}
            {!! request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? '&#9660;' : '&#9650;' !!}
        </span>
    </a>

    <div id="dropdownMenu" 
        style="margin-left:24px; flex-direction:column; 
            {{ request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? 'display:flex;' : 'display:none;' }}">
      
        <a href="/kolokiummhs" 
          class="submenu-link {{ request()->is('kolokiummhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-check2-circle"></i> Kolokium
        </a>
        <a href="/syaratkolokiummhs" 
          class="submenu-link {{ request()->is('syaratkolokiummhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-info-circle"></i> Syarat Kolokium
        </a>
        <a href="/seminarmhs" 
          class="submenu-link {{ request()->is('seminarmhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-calendar-event"></i> Seminar
        </a>
        <a href="/syaratseminarmhs" 
          class="submenu-link {{ request()->is('syaratseminarmhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-info-circle"></i> Syarat Seminar
        </a>
        <a href="/komprehensifmhs" 
          class="submenu-link {{ request()->is('komprehensifmhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-journal-text"></i> Komprehensif
        </a>
        <a href="/syaratkomprehensifmhs" 
          class="submenu-link {{ request()->is('syaratkomprehensifmhs') ? 'active-submenu' : '' }}">
            <i class="bi bi-info-circle"></i> Syarat Komprehensif
        </a>
    </div>

    <a href="/dashboardmhs" class="menu">
      <div class="menu-left">
        <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
      </div>
    </a>

    <script>
      document.getElementById('dropdownToggle').addEventListener('click', function(e) {
        e.preventDefault();
        var menu = document.getElementById('dropdownMenu');
        var arrow = document.getElementById('dropdownArrow');
        var isOpen = menu.style.display === 'flex';
        menu.style.display = isOpen ? 'none' : 'flex';
        arrow.innerHTML = isOpen ? '&#9650;' : '&#9660;'; // atas: &#9650;, bawah: &#9660;
      });
    </script>
  </aside>

<!-- MAIN KONTEN -->
<main class="content">
    <div class="container-fluid mt-4">
            <h2 class="page-title">Edit Password Akun</h2>
        </div> 
        <div class="d-flex justify-content-center align-items-center w-100 mt-4">
            <div class="card p-4 shadow-sm w-75 border-2" style="border:solid #1b2a6d">
            <div class="text-start mb-4">
                <label class="form-label fw-bold mb-0">Password Saat Ini</label>
                <input type="text" class="form-control" style="background-color:#f5f5f5" placeholder="Masukkan password saat ini">
            </div>
            <div class="text-start mb-4">
                <label class="form-label fw-bold mb-0">Password Baru</label>
                <input type="text" class="form-control" style="background-color:#f5f5f5" placeholder="Masukkan password baru">
            </div>
            <div class="text-start mb-4">
                <label class="form-label fw-bold mb-0">Konfirmasi Password Baru</label>
                <input type="text" class="form-control" style="background-color:#f5f5f5" placeholder="Konfirmasi password baru">
            </div>  
            <div class="row mt-4">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <a href="{{route('admprofile.index')}}" class="btn btn-secondary text-decoration-none">Kembali</a>
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection