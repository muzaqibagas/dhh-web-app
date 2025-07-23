
@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <a href="#" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      
      <a href="/dashboardmhs" class="menu active"><i class="bi bi-house-door-fill"></i> Beranda</a>
      <a href="/profilemhs" class="menu"><i class="bi bi-person"></i> Profil Mahasiswa</a>
      <a href="/formulirlayananakademik" class="menu"><i class="bi bi-file-earmark-text"></i> Formulir Layanan Akademik</a>
      <!-- <a href="#" class="menu"><i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir</a> -->
      <a href="" class="menu" id="dropdownToggle">
          <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
        <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/kolokium" class="submenu-link"><i class="bi bi-check2-circle"></i> Kolokium</a>
        <a href="/syaratkolokium" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Kolokium</a>
        <a href="/seminar" class="submenu-link"><i class="bi bi-calendar-event"></i> Seminar</a>
        <a href="/syaratseminar" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Seminar</a>
        <a href="/komprehensif" class="submenu-link"><i class="bi bi-journal-text"></i> Komprehensif</a>
        <a href="/syaratkomprehensif" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Komprehensif</a>
      </div>

      <a href="#" class="menu"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a>

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
    
    <main class="content">
      <div class="welcome-card">
        <h2>Halo, Muzaqi!</h2>
        <p class="welcome-text">
          Selamat datang di <b>Layanan Akademik Departemen Hasil Hutan</b>.  
          Pantau status akademikmu, ajukan kolokium dan seminar, serta unduh dokumen penting secara mudah dan cepat.
        </p>
      </div>

      <!-- Pengumuman -->
      <div class="pengumuman">
        <h4><i class="bi bi-megaphone"></i> Pengumuman Terbaru</h4>
        <ul>
          <li>Deadline pendaftaran kolokium: <b>20 Juli 2025</b></li>
          <li>Deadline pendaftaran seminar: <b>20 Juli 2025</b></li>
          <li>Sidang Akhir dimulai <b>10 Agustus 2025</b></li>
        </ul>
      </div>
      
      <!-- Status Cards -->
      <div class="status-cards">
        <div class="card waiting">
          <i class="bi bi-envelope"></i>
          <h5>Surat Undangan</h5>
          <p class="status">Menunggu Verifikasi</p>
        </div>
        <div class="card success">
          <i class="bi bi-journal-check"></i>
          <h5>Kolokium</h5>
          <p class="status">Sudah Mendaftar</p>
        </div>
        <div class="card danger">
          <i class="bi bi-calendar-event"></i>
          <h5>Seminar</h5>
          <p class="status">Belum Mendaftar</p>
        </div>
        <div class="card neutral">
          <i class="bi bi-file-earmark-text"></i>
          <h5>Sidang Akhir</h5>
          <p class="status">Belum Dijadwalkan</p>
        </div>
      </div>
    </main>
  </div>

@endsection
