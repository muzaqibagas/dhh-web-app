
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
		<a href="#" class="menu {{ request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? 'active' : '' }}" id="dropdownToggle">
			<i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
			<span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">
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
			arrow.innerHTML = isOpen ? '&#9650;' : '&#9660;';
			});     
		</script>
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
				<input type="text" value="{{ $komprehensifmhs->ruangan->nama ?? '-' }}" readonly>
			</div>
			<div class="form-group">
				<label>Ketua Sidang</label>
				<div class="form-static">[Diisi oleh akademik]</div>
			</div>
			<div class="form-actions mt-3 d-flex justify-content-end">
				<a href="{{ route('komprehensifmhs.edit', $komprehensifmhs->id) }}" class="btn btn-warning">Edit</a>
				<a href="{{ route('komprehensifmhs.pdf', $komprehensifmhs->id) }}" class="btn btn-primary">Download PDF</a>
			</div>
		</div>
	</main>
</div>

@endsection
