
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
		<h2 class="page-title">Edit Komprehensif</h2>    
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
		<form action="{{ route('komprehensifmhs.update', $komprehensifmhs->id) }}" method="POST">
			@csrf
			@method('PUT')   
			<div class="form-group">
			<label>Nama</label>
				<input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $komprehensifmhs->nama) }}" required>        
				<input type="hidden" name="id_mahasiswa" value="{{ $komprehensifmhs->id_mahasiswa }}">
			</div>
			<div class="form-group">
				<label>NIM</label>
				<input type="text" name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $komprehensifmhs->nim) }}" required>
			</div>
			<div class="form-group">
				<label>Semester</label>
				<select name="id_semester" required>
					<option disabled value="">Pilih Semester</option>
					@foreach ($semesters as $semester)
					<option value="{{ $semester->id }}" 
						{{ old('id_semester', $komprehensifmhs->id_semester) == $semester->id ? 'selected' : '' }}>
						{{ $semester->semester }}
					</option>
					@endforeach
				</select>
			</div>      
			<div class="form-group">
			<label>Alamat</label>
			<input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" 
					value="{{ old('alamat', $komprehensifmhs->alamat) }}" required>
			</div>      
			<div class="form-group">
			<label>Judul Tugas Akhir</label>
			<textarea name="judul_tugasakhir" placeholder="Masukkan Judul Tugas Akhir" required>{{ old('judul_tugasakhir', $komprehensifmhs->judul_tugasakhir) }}</textarea>
			</div>
			<div class="form-group">
			<label>Dosen Pembimbing 1</label>
			<select name="id_pembimbing1" required id="pembimbing1">          
				<option disabled value="">Pilih Dosen</option>
				@foreach ($listDosen as $dosen)
				<option value="{{ $dosen->id }}" 
					{{ old('id_pembimbing1', $komprehensifmhs->id_pembimbing1) == $dosen->id ? 'selected' : '' }}>
					{{ $dosen->nama }}
				</option>
				@endforeach
			</select>
			</div>
			<div class="form-group">
			<label>Dosen Pembimbing 2</label>
			<select name="id_pembimbing2" id="pembimbing2">                                                       
				<option value="">Pilih Dosen</option>
				@foreach ($listDosen as $dosen)
					<option value="{{ $dosen->id }}" 
						{{ old('id_pembimbing2', $komprehensifmhs->id_pembimbing2) == $dosen->id ? 'selected' : '' }}>
						{{ $dosen->nama }}
					</option>
				@endforeach                 
			</select>
			</div>      
			<div class="form-group">
			<label>Hari/Tanggal Sidang</label>        
			<input type="date" name="tanggal" 
					value="{{ old('tanggal', $komprehensifmhs->tanggal) }}" required>                 
			</div>
			<div class="form-group">
				<label>Waktu Sidang</label>
				<div class="d-flex align-items-center gap-3">
					<select id="waktu_mulai" class="w-25" name="waktu_mulai" required>
					<option value="">--:--</option>
					@foreach (["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00"] as $time)
						<option {{ old('waktu_mulai', \Carbon\Carbon::parse($komprehensifmhs->waktu_mulai)->format('H:i')) == $time ? 'selected' : '' }}>
							{{ $time }}
						</option>
					@endforeach
					</select>
					<p class="m-0">S/D</p>
					<select id="waktu_selesai" class="w-25" name="waktu_selesai" required>
					<option value="">--:--</option>
					@foreach (["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00"] as $time)
						<option {{ old('waktu_selesai', \Carbon\Carbon::parse($komprehensifmhs->waktu_selesai)->format('H:i')) == $time ? 'selected' : '' }}>
							{{ $time }}
						</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
			<label>Tempat Sidang</label>
			<select name="id_ruangan" required>
				<option disabled value="">Pilih Ruangan</option>
				@foreach ($ruangans as $ruangan)
				<option value="{{ $ruangan->id }}" 
					{{ old('id_ruangan', $komprehensifmhs->id_ruangan) == $ruangan->id ? 'selected' : '' }}>
					{{ $ruangan->nama }}
				</option>
				@endforeach
			</select>
			</div>      
			<div class="form-group">
			<label>Ketua Sidang</label>
			<div class="form-static">[Diisi oleh akademik]</div>
			</div>
			<div class="form-actions d-flex justify-content-end">
			<button type="submit" class="btn-submit">Update</button>
			</div>
		</form>
		</div>
	</main>
</div>

@push('styles')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
	$(document).ready(function () {
		let pembimbing1Val = "{{ old('id_pembimbing1', $komprehensifmhs->id_pembimbing1) }}";
		let pembimbing2Val = "{{ old('id_pembimbing2', $komprehensifmhs->id_pembimbing2) }}";
		$('#pembimbing1, #pembimbing2').select2({
			width: '100%',
			placeholder: "Pilih Dosen Pembimbing 2"
		});
		let originalPembimbing2 = $('#pembimbing2 option').clone();
		function filterPembimbing2(selected1) {
			$('#pembimbing2').empty();
			originalPembimbing2.each(function () {
				if ($(this).val() !== selected1) {
					$('#pembimbing2').append($(this).clone());
				}
			});
		}
		if (pembimbing1Val) {
			$('#pembimbing1').val(pembimbing1Val).trigger('change.select2');
			filterPembimbing2(pembimbing1Val);
		}
		if (pembimbing2Val) {
			$('#pembimbing2').val(pembimbing2Val).trigger('change.select2');
		} else {
			$('#pembimbing2').val('').trigger('change.select2');
		}
		$('#pembimbing1').on('change', function () {
			let selected1 = $(this).val();
			filterPembimbing2(selected1);
			$('#pembimbing2').val('').trigger('change.select2');
		});
	});
	</script>
	<script>
	document.getElementById('waktu_mulai').addEventListener('change', function() {
		let mulai = this.value;
		let selesaiSelect = document.getElementById('waktu_selesai');
		let semuaOpsi = selesaiSelect.querySelectorAll('option');
		semuaOpsi.forEach(opt => {
			if (!opt.value) return;
			let diff = (parseInt(opt.value.split(':')[0]) * 60 + parseInt(opt.value.split(':')[1])) -
						(parseInt(mulai.split(':')[0]) * 60 + parseInt(mulai.split(':')[1]));
			opt.style.display = diff >= 120 ? '' : 'none';
		});
		selesaiSelect.value = '';
	});
	</script>
@endpush

@endsection
