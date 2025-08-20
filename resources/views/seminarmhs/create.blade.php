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
            <h2 class="page-title">Daftar Seminar</h2>
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

            <form action="{{ route('seminarmhs.store') }}" method="POST">
                @csrf            
                <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{Auth::user()->nama ?? 'Guest'}}" required>
                <input type="hidden" name="id_mahasiswa" value="{{ Auth::user()->id }}">
                </div>

                <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM" value="" required>          
                </div>

                <div class="form-group">
                <label>Semester</label>
                    <select name="id_semester" required>
                        <option selected disabled value="">Pilih Semester</option>
                        @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                <label>Alamat di Bogor</label>
                <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" value="" required>
                </div>        

                <div class="form-group">
                <label>Judul Makalah Seminar</label>
                <textarea name="judul_seminar" placeholder="Masukkan Judul Seminar" value="" required></textarea>
                </div>

                <div class="form-group">
                    <label>Dosen Pembimbing 1</label>
                    <select name="id_pembimbing1" required id="pembimbing1">          
                        <option selected disabled value="">Pilih Dosen</option>
                        @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Dosen Pembimbing 2</label>
                    <select name="id_pembimbing2" id="pembimbing2">                                                       
                        <option selected disabled value="">Pilih Dosen</option>
                        @foreach ($listDosen as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                        @endforeach                 
                    </select>
                </div>

                <div class="form-group">
                    <label>Hari/Tanggal Seminar</label>
                    <input type="date" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label>Waktu Kolokium</label>
                    <div class="d-flex align-items-center gap-3">
                        <select id="waktu_mulai" class="w-25" name="waktu_mulai" required>
                        <option value="">--:--</option>
                        <option>08:00</option>
                        <option>08:30</option>
                        <option>09:00</option>
                        <option>09:30</option>
                        <option>10:00</option>
                        <option>10:30</option>
                        <option>11:00</option>
                        <option>11:30</option>
                        <option>12:00</option>
                        <option>12:30</option>
                        <option>13:00</option>
                        <option>13:30</option>
                        <option>14:00</option>
                        <option>14:30</option>
                        <option>15:00</option>
                        <option>15:30</option>
                        <option>16:00</option>
                        </select>
                        <p class="m-0">S/D</p>
                        <select id="waktu_selesai" class="w-25" name="waktu_selesai" required>
                        <option value="">--:--</option>
                        <option>08:00</option>
                        <option>08:30</option>
                        <option>09:00</option>
                        <option>09:30</option>
                        <option>10:00</option>
                        <option>10:30</option>
                        <option>11:00</option>
                        <option>11:30</option>
                        <option>12:00</option>
                        <option>12:30</option>
                        <option>13:00</option>
                        <option>13:30</option>
                        <option>14:00</option>
                        <option>14:30</option>
                        <option>15:00</option>
                        <option>15:30</option>
                        <option>16:00</option>
                        </select>
                    </div>
                    </div>

                <div class="form-group">
                    <label>Tempat Seminar</label>
                    <select name="id_ruangan" required>
                        <option selected disabled value="">Pilih Ruangan</option>
                        @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Dosen Moderator</label>
                    <div class="form-static">[Diisi oleh akademik]</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Submit</button>
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

@endpush

@endsection

</body>
