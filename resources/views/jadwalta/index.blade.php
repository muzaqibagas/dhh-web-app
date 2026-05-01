@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <div class="d-flex align-items-center menu pb-0 mb-0 pt-0 mt-0">               
        <h5 class="fw-bold" style="color: #721B29">{{ Auth::guard('staff')->user()->nama ?? 'Guest' }}</h5>                                                      
      </div>
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- Untuk aktifin button sub menu ========================= -->
      @php
        $isDashboardActive = Request::is('dashboarddosen');
        $isJadwalTAActive = Request::is('jadwalta');
        $isPenilaianActive = Request::is('penilaian');
        $isFormulirLayananActive = Request::is('formulirlayananakademikmhs');        
        $isProfileMahasiswaActive = Request::is('profiledosen') || Request::is('user/*/edit') || Request::is('profiledosen/edit') || Request::is('editpassdosen');
        $isLogoutmhsActive = Request::is('logoutmhs');
        @endphp

      <!-- BTN BERANDA ===================== -->
      <a href="{{ route('dashboarddosen.index') }}" class="menu {{ $isDashboardActive ? 'active' : '' }}">
        <div class="menu-left">
          <i class="bi bi-house-door-fill"></i>
          <span> Beranda </span>
        </div>
      </a>
      <a href="{{ route('jadwalta.index') }}" class="menu {{ $isJadwalTAActive ? 'active' : '' }}">
        <div class="menu-left">          
          <i class="bi bi-calendar-event-fill"></i>
          <span> Jadwal TA </span>
        </div>
      </a>
      <a href="{{ route('penilaian.index') }}" class="menu {{ $isPenilaianActive ? 'active' : '' }}">
        <div class="menu-left">          
          <i class="bi bi-file-earmark-bar-graph-fill"></i>
          <span> Penilaian </span>
        </div>
      </a>
      
      <!-- PEMBATAS EMAS ===================== -->
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>


      <!-- BTN Profile MHS ===================== -->
      <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profiledosen">
        <div class="menu-left">
          <i class="bi bi-person"></i>
          <span> Profil Dosen </span>
        </div>
        <span class="dropdownArrow" data-arrow="profiledosen">
          {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="profiledosen"
        style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/profiledosen"
          class="submenu-link {{ Request::is('profiledosen', 'profiledosen/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-person-workspace"></i> Biodata Dosen
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
        <div class="d-flex adm-header justify-content-end">
            <div class="d-flex justify-content-end align-items-center gap-2">                    
              <form action="{{ route('jadwalta.index') }}" method="GET" class="d-flex justify-content-end align-items-center gap-2 w-100">
                <input type="text" name="search" class="form-control w-100" placeholder="Cari Mahasiswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-3">
                  <i class="bi bi-search"></i>
                </button>
              </form>              
            </div> 
        </div>    
            
        <table style="
            width:100%;
            border-collapse:collapse;
            background-color:#ffffff;
            border-radius:8px;
            overflow:hidden;
            box-shadow:0 2px 6px rgba(0,0,0,0.08);
        ">
            <thead style="background-color:#1e3a8a; color:#ffffff;">
                <tr>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Nama Mahasiswa</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">NIM</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Jenis Ujian</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Tanggal</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Waktu</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Ruangan</th>
                    <th style="padding:12px 14px; font-size:14px; text-align:left;">Status</th>                    
                </tr>
            </thead>

            <tbody>
              @foreach($jadwals as $i => $item)
                <tr style="background-color:#ffffff;">
                    <td style="padding:12px 14px;">{{ $item['nama'] }}</td>
                    <td style="padding:12px 14px;">{{ $item['nim'] }}</td>
                    <td style="padding:12px 14px;">{{ $item['jenis'] }}</td>
                    <td style="padding:12px 14px;">{{ $item['tanggal'] }}</td>
                    <td style="padding:12px 14px;">{{ $item['mulai'] }} - {{ $item['selesai'] }}</td>
                    <td style="padding:12px 14px;">{{ $item['ruangan'] }}</td>
                    <td style="padding:12px 14px;">
                        @if($item['bap'] === 'ditolak')
                            <span style="
                                padding:4px 10px;
                                border-radius:12px;
                                font-size:12px;
                                font-weight:bold;
                                background-color:#fecaca;
                                color:#7f1d1d;
                            ">
                                Dibatalkan
                            </span>

                        @elseif($item['bap'] === 'diterima')
                            <span style="
                                padding:4px 10px;
                                border-radius:12px;
                                font-size:12px;
                                font-weight:bold;
                                background-color:#bbf7d0;
                                color:#166534;
                            ">
                                Selesai
                            </span>

                        @elseif($item['status'] === 'disetujui')
                            <span style="
                                padding:4px 10px;
                                border-radius:12px;
                                font-size:12px;
                                font-weight:bold;
                                background-color:#bfdbfe;
                                color:#1e40af;
                            ">
                                Terjadwal
                            </span>

                        @else
                            <span style="
                                padding:4px 10px;
                                border-radius:12px;
                                font-size:12px;
                                font-weight:bold;
                                background-color:#e5e7eb;
                                color:#374151;
                            ">
                                Menunggu
                            </span>
                        @endif
                    </td>                    
                </tr>  
              @endforeach              
        </table>        
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
