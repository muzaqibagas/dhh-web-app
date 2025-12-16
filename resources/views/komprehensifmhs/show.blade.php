
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
        $isTingkatAkhirActive = 
        Request::is('kolokiummhs') || Request::is('kolokiummhs/*') || Request::is('kolokiummhs/*/edit') || Request::is('syaratkolokiummhs/*') || 
        Request::is('seminarmhs') || Request::is('seminarmhs/*') || Request::is('seminarmhs/*/edit') || Request::is('syaratseminarmhs/*') || 
        Request::is('komprehensifmhs') || Request::is('komprehensifmhs/*') || Request::is('komprehensifmhs/*/edit') || Request::is('syaratkomprehensifmhs/*');
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
          class="submenu-link {{ Request::is('kolokiummhs', 'kolokiummhs*', 'kolokiummhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Kolokium
        </a>
        <a href="/syaratkolokiummhs/create"
          class="submenu-link {{ Request::is('syaratkolokiummhs', 'syaratkolokiummhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Kolokium
        </a>
        <a href="/seminarmhs"
          class="submenu-link {{ Request::is('seminarmhs', 'seminarmhs*', 'seminarmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Seminar
        </a>
        <a href="/syaratseminarmhs/create"
          class="submenu-link {{ Request::is('syaratseminarmhs', 'syaratseminarmhs/*', 'syaratseminarmhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Seminar
        </a>
        <a href="/komprehensifmhs"
          class="submenu-link {{ Request::is('komprehensifmhs', 'komprehensifmhs*', 'komprehensifmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Komprehensif
        </a>
        <a href="/syaratkomprehensifmhs/create"
          class="submenu-link {{ Request::is('syaratkomprehensifmhs', 'syaratkomprehensifmhs/*') ? 'active-submenu' : '' }}">
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
			<h2 class="page-title">Detail Pendaftaran Komprehensif</h2>
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

			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" value="{{ old('nama', $komprehensifmhs->nama) }}" readonly required>
				<input type="hidden" name="id_mahasiswa" value="{{ $komprehensifmhs->id_mahasiswa }}">
			</div>
			<div class="form-group">
				<label>NIM</label>
				<input type="text" name="nim" value="{{ old('nim', $komprehensifmhs->nim) }}" readonly required>
			</div>
			<div class="form-group">
				<label>Semester</label>
				<input type="text" value="{{ $komprehensifmhs->semester->semester }}" readonly required>
			</div>
			<div class="form-group">
				<label>Alamat di Bogor</label>
				<input type="text" value="{{ $komprehensifmhs->alamat ?? '-' }}" readonly required>
			</div>
			<div class="form-group">
				<label>Judul Tugas Akhir</label>
				<textarea readonly>{{ $komprehensifmhs->judul_tugasakhir }}</textarea>
			</div>
			<div class="form-group">
				<label>Dosen Pembimbing 1</label>
				<input type="text" value="{{ $komprehensifmhs->pembimbing1->nama ?? '-' }}" readonly>
			</div>
			<div class="form-group">
				<label>Dosen Pembimbing 2</label>
				<input type="text" value="{{ $komprehensifmhs->pembimbing2->nama ?? '-' }}" readonly>
			</div>
      <div class="form-group">
        <label>Komisi Pendidikan</label>
        <input type="text" value="{{ $komprehensifmhs->komisiPendidikan->nama ?? '-' }}" readonly>
      </div>
			<div class="form-group">
				<label>Hari/Tanggal Sidang</label>
				<input type="date" value="{{ \Carbon\Carbon::parse($komprehensifmhs->tanggal)->format('Y-m-d') }}" readonly>				
			</div>
			<div class="form-group">
				<label>Waktu Sidang</label>
				<div class="d-flex align-items-center gap-3">
					<input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($komprehensifmhs->waktu_mulai)->format('H:i') }}" readonly>
					<p class="m-0">S/D</p>
					<input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($komprehensifmhs->waktu_selesai)->format('H:i') }}" readonly>
				</div>
			</div>			
			<div class="form-group">
				<label>Tempat Sidang</label>
        <input type="text" class="text-success fw-bold" value="{{ $komprehensifmhs->syaratKomprehensif->ruangan ?? '[Diisi oleh akademik]' }}" readonly>						
			</div>  
			<div class="form-group">
				<label>Ketua Sidang</label>
				<input type="text" class="text-success fw-bold" value="{{ $komprehensifmhs->syaratKomprehensif->moderator->nama ?? '[Diisi oleh akademik]' }}" readonly>				
			</div>
			<div class="form-group">
				<label>Dosen Penguji</label>
				<input type="text" class="text-success fw-bold" value="{{ $komprehensifmhs->syaratKomprehensif->penguji->nama ?? '[Diisi oleh akademik]' }}" readonly>				
			</div>
			<div class="form-actions mt-3 d-flex justify-content-end">
				<a href="{{ route('komprehensifmhs.edit', $komprehensifmhs->id) }}" class="btn btn-warning">Edit</a>
				<a href="{{ route('komprehensifmhs.pdf', $komprehensifmhs->id) }}" class="btn btn-primary">Download PDF</a>
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
