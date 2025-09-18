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
          <div class="form-static">[Diisi oleh akademik]</div>
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

</body>
