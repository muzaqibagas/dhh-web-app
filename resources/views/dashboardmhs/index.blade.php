@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <a href="#" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      
      <a href="/dashboardmhs" class="menu active">
        <div class="menu-left">
          <i class="bi bi-house-door-fill"></i> <span> Beranda </span>
        </div>
      </a>
      <a href="/profilemhs" class="menu ">
        <div class="menu-left">
          <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
        </div>
      </a>
      <a href="/formulirlayananakademikmhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-file-earmark-text"></i> <span> Formulir Layanan Akademik </span>
        </div>
      </a>
      <a href="" class="menu" id="dropdownToggle">
        <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
        <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/kolokiummhs" class="submenu-link"><i class="bi bi-check2-circle"></i> Kolokium</a>
        <a href="/syaratkolokiummhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Kolokium</a>
        <a href="/seminarmhs" class="submenu-link"><i class="bi bi-calendar-event"></i> Seminar</a>
        <a href="/syaratseminarmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Seminar</a>
        <a href="/komprehensifmhs" class="submenu-link"><i class="bi bi-journal-text"></i> Komprehensif</a>
        <a href="/syaratkomprehensifmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Komprehensif</a>
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
    
    <main class="content">
      <div class="welcome-card">
        <div class="d-flex flex-column">
          <h2>Halo, {{ Auth::user()->nama ?? 'Guest' }} {{ Auth::user()->nim ? Auth::user()->nim : '' }}!</h2>          
        </div>         

        <p class="welcome-text">
          Selamat datang di <b>Layanan Akademik Departemen Hasil Hutan</b>.  
          Pantau status akademikmu, ajukan kolokium dan seminar, serta unduh dokumen penting secara mudah dan cepat.
        </p>
      </div>

      <div>
        <div></div>
        <div></div>
      </div>
      
      <!-- Status Cards -->
      <div class="status-cards">
        <div class="pengumuman">
          <h4><i class="bi bi-megaphone"></i> Notifikasi</h4>
          <div class="overflow-auto" style="max-height: 300px;">
            @forelse($notifications as $notif)
              <a href="{{ route('notification.open', $notif->id) }}" class="text-decoration-none text-dark">              
                <div class="card text-start mb-2 p-2" @if(!$notif->is_read) style="background-color: #013880; color: #fff;" @endif>
                  <h6><b>{{ $notif->title }}</b><br></h6>
                  <h6>{!! $notif->message !!}</h6>
                  <div class="text-muted" @if(!$notif->is_read) style="color: #7e7e7eff !important; font-size: 12px" @endif>
                    {{ $notif->created_at->diffForHumans() }}
                  </div>
                </div>
              </a>
            @empty
              <div class="card text-start p-2">Tidak ada notifikasi</div>
            @endforelse
          </div>
        </div>
        <div class="status-cards-left">
          @php
              $status = $kolokium->status ?? 'belum_mendaftar';
              $bap = $kolokium->bap ?? 'belum_melaksanakan';

              if ($bap === 'diterima') {
                  $label = "Telah Selesai";
                  $badgeClass = "badge bg-success";
              } elseif ($status === 'pending') {
                  $label = "Menunggu Verifikasi";
                  $badgeClass = "badge bg-warning text-dark";
              } elseif ($status === 'disetujui') {
                  $label = "Sudah Mendaftar";
                  $badgeClass = "badge bg-success";
              } elseif ($status === 'ditolak') {
                  $label = "Persyaratan Ditolak";
                  $badgeClass = "badge bg-danger";
              } else {
                  $label = "Belum Mendaftar";
                  $badgeClass = "badge bg-secondary";
              }
          @endphp          
          
          <div class="card">
              <i class="bi bi-journal-check"></i>
              <h5>Kolokium</h5>
              <p class="status">
                  <span class="{{ $badgeClass }}">{{ $label }}</span>
              </p>
          </div>      
          <div class="card">
            <i class="bi bi-calendar-event"></i>
            <h5>Seminar Hasil</h5>
            <p class="status">
              <span class="{{ $badgeClass }}">{{ $label }}</span>
            </p>
          </div>
          <div class="card sidang-full">
            <i class="bi bi-file-earmark-text"></i>
            <h5>Komprehensif</h5>
            <p class="status">
              <span class="{{ $badgeClass }}">{{ $label }}</span>
            </p>
          </div>
        </div>        
      </div>
    </main>
  </div>

@endsection
