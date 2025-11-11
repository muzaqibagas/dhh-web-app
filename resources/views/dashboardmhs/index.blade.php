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
              $status_k = $kolokium->status ?? 'belum_mendaftar';
              $bap_k = $kolokium->bap ?? 'belum_melaksanakan';

              if ($bap_k === 'diterima') {
                  $label_k = "Telah Selesai";
                  $badge_k = "badge bg-success";
              } elseif ($status_k === 'pending') {
                  $label_k = "Menunggu Verifikasi";
                  $badge_k = "badge bg-warning text-dark";
              } elseif ($status_k === 'disetujui') {
                  $label_k = "Sudah Mendaftar";
                  $badge_k = "badge bg-success";
              } elseif ($status_k === 'ditolak') {
                  $label_k = "Persyaratan Ditolak";
                  $badge_k = "badge bg-danger";
              } else {
                  $label_k = "Belum Mendaftar";
                  $badge_k = "badge bg-secondary";
              }
          @endphp                    
          <div class="card">
              <i class="bi bi-journal-check"></i>
              <h5>Kolokium</h5>
              <p class="status">
                  <span class="{{ $badge_k }}">{{ $label_k }}</span>
              </p>
          </div>      

          @php
              $status_s = $seminar->status ?? 'belum_mendaftar';
              $bap_s = $seminar->bap ?? 'belum_melaksanakan';

              if ($bap_s === 'diterima') {
                  $label_s = "Telah Selesai";
                  $badge_s = "badge bg-success";
              } elseif ($status_s === 'pending') {
                  $label_s = "Menunggu Verifikasi";
                  $badge_s = "badge bg-warning text-dark";
              } elseif ($status_s === 'disetujui') {
                  $label_s = "Sudah Mendaftar";
                  $badge_s = "badge bg-success";
              } elseif ($status_s === 'ditolak') {
                  $label_s = "Persyaratan Ditolak";
                  $badge_s = "badge bg-danger";
              } else {
                  $label_s = "Belum Mendaftar";
                  $badge_s = "badge bg-secondary";
              }
          @endphp 
          <div class="card">
            <i class="bi bi-calendar-event"></i>
            <h5>Seminar Hasil</h5>
            <p class="status">
              <span class="{{ $badge_s }}">{{ $label_s }}</span>
            </p>
          </div>

          @php
              $status_c = $komprehensif->status ?? 'belum_mendaftar';
              $bap_c = $komprehensif->bap ?? 'belum_melaksanakan';

              if ($bap_c === 'diterima') {
                  $label_c = "Telah Selesai";
                  $badge_c = "badge bg-success";
              } elseif ($status_c === 'pending') {
                  $label_c = "Menunggu Verifikasi";
                  $badge_c = "badge bg-warning text-dark";
              } elseif ($status_c === 'disetujui') {
                  $label_c = "Sudah Mendaftar";
                  $badge_c = "badge bg-success";
              } elseif ($status_c === 'ditolak') {
                  $label_c = "Persyaratan Ditolak";
                  $badge_c = "badge bg-danger";
              } else {
                  $label_c = "Belum Mendaftar";
                  $badge_c = "badge bg-secondary";
              }
          @endphp 
          <div class="card sidang-full">
            <i class="bi bi-file-earmark-text"></i>
            <h5>Komprehensif</h5>
            <p class="status">
              <span class="{{ $badge_c }}">{{ $label_c }}</span>
            </p>
          </div>
        </div>        
      </div>
    </main>
  </div>
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
