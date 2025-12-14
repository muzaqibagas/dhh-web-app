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
            <h2 class="page-title">Detail Pendaftaran Kolokium</h2>
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $kolokiummhs->nama) }}" readonly required>
                <input type="hidden" name="id_mahasiswa" value="{{ $kolokiummhs->id_mahasiswa }}">
            </div>

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $kolokiummhs->nim)}}" readonly required>
            </div>
            
            <div class="form-group">
                <label>Semester</label>
                <input type="text" value="{{ $kolokiummhs->semester->semester ?? '-' }}" placeholder="Masukkan Semester" readonly required>                                          
            </div>

            <div class="form-group">
                <label>Alamat di Bogor </label>
                <input type="text" value="{{ $kolokiummhs->alamat ?? '-' }}" placeholder="Masukkan Alamat Lengkap" readonly required>
            </div> 

            <div class="form-group">
                <label>Judul Makalah Kolokium</label>
                <textarea placeholder="Masukkan Judul" readonly>{{ $kolokiummhs->judul_kolokium }}</textarea>
            </div>

            <div class="form-group">
                <label>Dosen Pembimbing 1</label>
                <input type="text" value="{{ $kolokiummhs->pembimbing1->nama ?? '-' }}" readonly>
            </div>

            <div class="form-group">
                <label>Dosen Pembimbing 2</label>
                <input type="text" value="{{ optional($kolokiummhs->pembimbing2)->nama ?? '-' }}" readonly>
            </div>      

            <div class="form-group">
                <label>Komisi Pendidikan</label>
                <input type="text" value="{{ $kolokiummhs->komisipendidikan->nama ?? '-' }}" readonly>
            </div>

            <div class="form-group">
                <label>Hari/Tanggal Kolokium</label>                        
                <input type="date" value="{{ \Carbon\Carbon::parse($kolokiummhs->tanggal)->format('Y-m-d') }}" readonly>                
            </div>

            <div class="form-group">
                <label>Waktu Kolokium</label>
                <div class="d-flex align-items-center gap-3">                    
                    <input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($kolokiummhs->waktu_mulai)->format('H:i') }}" readonly>
                    <p class="m-0">S/D</p>
                    <input type="text" class="w-25" value="{{ \Carbon\Carbon::parse($kolokiummhs->waktu_selesai)->format('H:i') }}" readonly>                    
                </div>
            </div>

            <div class="form-group">
                <label>Tipe Pelaksanaan</label>
                <input type="text" value="{{ ucfirst($kolokiummhs->tipe_pelaksanaan) }}" readonly>
            </div>
             
            <div class="form-group">
                <label>Tempat Kolokium</label>
                @if ($kolokiummhs->tipe_pelaksanaan === 'offline')
                    <input type="text" value="{{ optional($kolokiummhs->ruangan)->nama ?? '-' }}" readonly>                                     
                @elseif ($kolokiummhs->tipe_pelaksanaan === 'online')
                    <input type="text" value="{{ $kolokiummhs->link_meeting ?? '-' }}" readonly>
                @else
                    <input type="text" value="-" readonly>
                @endif
            </div>            

            <div class="form-group">
                <label>Dosen Moderator</label>
                <input type="text" class="text-success fw-bold" value="{{ optional($kolokiummhs->syaratKolokium?->moderator)->nama ?? '[Diisi oleh akademik]' }}" readonly>                                                                                                                                             
            </div>
            <div class="form-actions mt-3 d-flex justify-content-end">
                <a href="{{ route('kolokiummhs.edit', $kolokiummhs->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('kolokiummhs.pdf', $kolokiummhs->id) }}" class="btn btn-primary">Download PDF</a>
            </div>
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
      // Inisialisasi Select2
      $('#pembimbing1').select2({
          width: '100%',
          placeholder: "Pilih Dosen Pembimbing 1"
      });

      $('#pembimbing2').select2({
          width: '100%',
          placeholder: "Pilih Dosen Pembimbing 2"
      });

      // Simpan semua opsi awal pembimbing2
      let originalPembimbing2 = $('#pembimbing2 option').clone();

      // Saat pembimbing1 berubah
      $('#pembimbing1').on('change', function () {
          let selected1 = $(this).val();

          // Kosongkan pembimbing2
          $('#pembimbing2').empty();

          // Masukkan opsi kecuali yang dipilih di pembimbing1
          originalPembimbing2.each(function () {
              if ($(this).val() !== selected1) {
                  $('#pembimbing2').append($(this).clone());
              }
          });

          // Reset pilihan pembimbing2
          $('#pembimbing2').val(null).trigger('change');
      });
  });
  </script>

  <script>
  document.getElementById('waktu_mulai').addEventListener('change', function() {
      let mulai = this.value;
      let selesaiSelect = document.getElementById('waktu_selesai');

      // Ambil semua opsi selesai
      let semuaOpsi = selesaiSelect.querySelectorAll('option');

      semuaOpsi.forEach(opt => {
          if (!opt.value) return; // skip placeholder
          let diff = (parseInt(opt.value.split(':')[0]) * 60 + parseInt(opt.value.split(':')[1])) -
                    (parseInt(mulai.split(':')[0]) * 60 + parseInt(mulai.split(':')[1]));
          
          // Kalau selisihnya < 120 menit (2 jam), sembunyikan
          opt.style.display = diff >= 120 ? '' : 'none';
      });

      // Reset pilihan selesai
      selesaiSelect.value = '';
  });
  </script>

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

</body>
