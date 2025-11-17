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
      $isTingkatAkhirActive = Request::is('kolokiummhs') || Request::is('syaratkolokiummhs') || Request::is('seminarmhs*') || Request::is('syaratseminarmhs') || Request::is('komprehensifmhs') || Request::is('syaratkomprehensifmhs');
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
        class="submenu-link {{ Request::is('seminarmhs*') ? 'active-submenu' : '' }}">
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
    <div class="kolokium-card">
      <h2 class="page-title">Detail Pendaftaran Seminar</h2>
      @if (session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
			@if (session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{ session('error') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif

      <form>
        <div class="form-group">
          <label>Nama</label>          
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $seminarmhs->nama) }}" readonly required>
          <input type="hidden" name="id_mahasiswa" value="{{ $seminarmhs->id_mahasiswa }}">
        </div>

        <div class="form-group">
          <label>NIM</label>          
          <input type="text" name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $seminarmhs->nim)}}" readonly required>
        </div>

        <div class="form-group">
          <label>Semester</label>
          <input type="text" value="{{ $seminarmhs->semester->semester}}" placeholder="Masukkan Semester" readonly required>          
        </div>

        <div class="form-group">
          <label>Alamat di Bogor</label>          
          <input type="text" value="{{ $seminarmhs->alamat ?? '-' }}" placeholder="Masukkan Alamat Lengkap" readonly required>
        </div>        

        <div class="form-group">
          <label>Judul Makalah Seminar</label>          
          <textarea placeholder="Masukkan Judul" readonly>{{ $seminarmhs->judul_seminar }}</textarea>
        </div>

        <div class="form-group">
          <label>Dosen Pembimbing 1</label>
          <input type="text" value="{{ $seminarmhs->pembimbing1->nama ?? '-' }}" readonly>
        </div>

        <div class="form-group">
          <label>Dosen Pembimbing 2</label>
          <input type="text" value="{{ $seminarmhs->pembimbing2->nama ?? '-' }}" readonly>
        </div>

        <div class="form-group">
            <label>Komisi Pendidikan</label>
            <input type="text" value="{{ $seminarmhs->komisiPendidikan->nama ?? '-' }}" readonly>
        </div>

        <div class="form-group">
          <label>Hari/Tanggal Seminar</label>
          <input type="date" value="{{ \Carbon\Carbon::parse($seminarmhs->tanggal)->format('Y-m-d') }}" readonly>
        </div>

        <div class="form-group">
          <label>Waktu Seminar</label>
          <div class="d-flex align-items-center gap-3">                    
              <input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($seminarmhs->waktu_mulai)->format('H:i') }}" readonly>
              <p class="m-0">S/D</p>
              <input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($seminarmhs->waktu_selesai)->format('H:i') }}" readonly>                    
          </div>
        </div>

        <div class="form-group">
          <label>Tipe Pelaksanaan</label>
          <input type="text" value="{{ ucfirst($seminarmhs->tipe_pelaksanaan) }}" readonly>
        </div>

        <div class="form-group">
          <label>Tempat Seminar</label>
          @if ($seminarmhs->tipe_pelaksanaan === 'offline')
            <input type="text" value="{{ $seminarmhs->ruangan->nama ?? '-' }}" readonly>
          @elseif ($seminarmhs->tipe_pelaksanaan === 'online')
            <input type="text" value="{{ $seminarmhs->link_meeting ?? '-' }}" readonly>
          @else
            <input type="text" value="-" readonly>
          @endif
        </div>  

        <div class="form-group">
          <label>Dosen Moderator</label>          
          <input type="text" class="text-success fw-bold" value="{{ $seminarmhs->syaratSeminar->moderator->nama ?? '[Diisi oleh akademik]' }}" readonly>
        </div>

        <div class="form-actions mt-3 d-flex justify-content-end">                
          <a href="{{ route('seminarmhs.edit', $seminarmhs->id) }}" class="btn btn-warning">Edit</a>                
          <a href="{{ route('seminarmhs.pdf', $seminarmhs->id) }}" class="btn btn-primary">Download PDF</a>                                   
        </div>
      </form>
    </div>
  </main>
</div>
@endsection
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
</body>
