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
        <a href="{{ route('syaratujian.create', ['jenis' => 'kolokium']) }}"          
          class="submenu-link {{ request()->routeIs('syaratujian.create') && request('jenis') == 'kolokium' ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Kolokium
        </a>
        <a href="/seminarmhs"
          class="submenu-link {{ Request::is('seminarmhs', 'seminarmhs*', 'seminarmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Seminar
        </a>
        <a href="{{ route('syaratujian.create', ['jenis' => 'seminar']) }}"                    
          class="submenu-link {{ request()->routeIs('syaratujian.create') && request('jenis') == 'seminar' ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Seminar
        </a>
        <a href="/komprehensifmhs"
          class="submenu-link {{ Request::is('komprehensifmhs', 'komprehensifmhs*', 'komprehensifmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Komprehensif
        </a>
        <a href="{{ route('syaratujian.create', ['jenis' => 'komprehensif']) }}"  
          class="submenu-link {{ request()->routeIs('syaratujian.create') && request('jenis') == 'komprehensif' ? 'active-submenu' : '' }}">
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
                {!! session('error') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="{{ route('seminarmhs.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ Auth::user()->nama ?? 'Guest' }}" required readonly>
            <input type="hidden" name="id_mahasiswa" value="{{ Auth::id() }}">            
          </div>

          <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" placeholder="Masukkan NIM" value="{{ Auth::user()->nim }}" required readonly>            
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
            <textarea name="judul_seminar" placeholder="Masukkan Judul Seminar" required>{{ old('judul_seminar') }}</textarea>            
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
              <option value="">Pilih Dosen</option>
              @foreach ($listDosen as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
              @endforeach
            </select>            
          </div>

          <div class="form-group">
            <label>Komisi Pendidikan</label>
            <select name="id_komisipendidikan" id="komisipendidikan" required>
              <option selected disabled value="">Pilih Dosen</option>
              @foreach ($listDosen as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
              @endforeach                 
            </select>
          </div> 

          <div class="form-group">
            <label>Hari/Tanggal Seminar</label>
            <div>
              <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
              <small id="tanggal-error" style="color:red;display:none;">Tanggal Sabtu/Minggu tidak bisa dipilih.</small>
            </div>
          </div>

          <div class="form-group">
            <label>Waktu Seminar</label>
            <div>
              <div class="d-flex align-items-center gap-3">
                <input type="time" id="waktu_mulai" name="waktu_mulai" min="08:00" max="16:00" value="{{ old('waktu_mulai') }}" required>
                <p class="m-0">S/D</p>
                <input type="time" id="waktu_selesai" name="waktu_selesai" min="08:00" max="16:00" value="{{ old('waktu_selesai') }}" required>
              </div>
              <small id="waktu-error" style="color:red;display:none;">Waktu Seminar tidak boleh pada jam istirahat (12:00 - 13:00).</small>
            </div>
          </div>

          <div class="form-group">
            <label for="tipe">Tipe Pelaksanaan</label>
            <select id="tipe" name="tipe_pelaksanaan" required>
              <option value="offline">Offline</option>
              <option value="online">Online (Zoom/Meet)</option>
            </select>            
          </div>

          <div class="form-group" id="ruangan-field">
            <label for="id_ruangan">Ruangan</label>
            <select name="id_ruangan" id="id_ruangan">
              <option value="">Pilih Ruangan</option>
              @foreach($ruanganSeminar as $ruangan)
                <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
              @endforeach
            </select>            
          </div>

          <div class="form-group d-none" id="link-field">
            <label for="link_meeting">Link Meeting</label>
            <input type="url" name="link_meeting" id="link_meeting" placeholder="https://zoom.us/..." value="{{ old('link_meeting') }}">            
          </div>          

          <div class="form-group">
            <label>Dosen Moderator</label>          
            <input type="text" class="text-success fw-bold" value="[Diisi oleh akademik]" readonly>
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
  <!-- waktu pendaftaran minimal 4 hari kerja dan sabtu minggu tidak boleh -->
  <!-- tanggal -->
  <script>
    document.getElementById('tanggal').addEventListener('change', function() {
        const val = this.value;
        if (!val) return;
        const date = new Date(val);
        const day = date.getDay();
        // Cek Sabtu/Minggu
        if (day === 0 || day === 6) {
            this.value = '';
            document.getElementById('tanggal-error').textContent = 'Tanggal Sabtu/Minggu tidak bisa dipilih.';
            document.getElementById('tanggal-error').style.display = 'inline';
            return;
        }
        // Hitung minimal 4 hari kerja dari hari ini
        let today = new Date();
        today.setHours(0,0,0,0);
        let workDays = 0;
        let tempDate = new Date(today);
        while (workDays < 4) {
            tempDate.setDate(tempDate.getDate() + 1);
            let tempDay = tempDate.getDay();
            if (tempDay !== 0 && tempDay !== 6) {
                workDays++;
            }
        }
        // tempDate sekarang adalah minimal tanggal yang boleh dipilih
        if (date < tempDate) {
            this.value = '';
            document.getElementById('tanggal-error').textContent = 'Tanggal harus minimal 4 hari kerja dari hari ini.';
            document.getElementById('tanggal-error').style.display = 'inline';
            return;
        }
        document.getElementById('tanggal-error').style.display = 'none';
    });
  </script>

  <!-- waktu kolokium -->
  <script>
    const waktuMulaiInput = document.getElementById('waktu_mulai');
    const waktuSelesaiInput = document.getElementById('waktu_selesai');
    const waktuError = document.getElementById('waktu-error');

    function validasiJam(input) {
      let val = input.value;
      if (!val) return false;

      if (val < "08:00" || val > "16:00") {
        input.value = "";
        waktuError.style.display = "inline";
        waktuError.textContent = "Jam harus antara 08:00 - 16:00.";
        return false;
      }
      return true;
    }

    waktuMulaiInput.addEventListener("change", function() {
      if (!validasiJam(this)) return;
      
      if (this.value >= "12:00" && this.value < "13:00") {
        this.value = "";
        waktuError.style.display = "inline";
        waktuError.textContent = "Tidak boleh pada jam istirahat (12:00 - 13:00).";
        waktuSelesaiInput.value = "";
        return;
      }
      
      let [jam, menit] = this.value.split(":").map(Number);
      let totalMenit = jam * 60 + menit + 60;

      if (totalMenit > 12 * 60 && jam < 12) {
          totalMenit += 60;
      }
      if (totalMenit > 17 * 60) totalMenit = 17 * 60;    

      let jamSelesai = Math.floor(totalMenit / 60);
      let menitSelesai = totalMenit % 60;    
      let jamStr = jamSelesai.toString().padStart(2, "0");
      let menitStr = menitSelesai.toString().padStart(2, "0");
      waktuSelesaiInput.value = `${jamStr}:${menitStr}`;
      waktuError.style.display = "none";        
    });

    waktuSelesaiInput.addEventListener("change", function() {
      if (!validasiJam(this)) return;

      let mulai = waktuMulaiInput.value;

      if (this.value > "12:00" && this.value <= "13:00") {
        this.value = "";
        waktuError.style.display = "inline";
        waktuError.textContent = "Tidak boleh pada jam istirahat (12:00 - 13:00).";
        return;
      }
      if (mulai && this.value <= mulai) {
        this.value = "";
        waktuError.style.display = "inline";
        waktuError.textContent = "Waktu selesai harus lebih besar dari waktu mulai.";
        return;
      }

      waktuError.style.display = "none";
    });
  </script>

  <!-- dosen Pembimbing -->
  <script>
    $(document).ready(function () {
        // Inisialisasi Select2
        $('#pembimbing1').select2({
            width: '100%',
            placeholder: "Pilih Dosen Pembimbing 1",
            allowClear: true,
        });

        $('#pembimbing2').select2({
            width: '100%',
            placeholder: "Pilih Dosen Pembimbing 2",
            allowClear: true,
        });

        $('#komisipendidikan').select2({
            width: '100%',
            placeholder: "Pilih Komisi Pendidikan",
            allowClear: true,
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

  <!-- ruangan -->
  <script>
    const tipe = document.getElementById('tipe');
    const ruanganField = document.getElementById('ruangan-field');
    const linkField = document.getElementById('link-field');

    function toggleTipe() {
      if (tipe.value === 'online') {
        ruanganField.classList.add('d-none');
        linkField.classList.remove('d-none');
        document.getElementById('id_ruangan').removeAttribute('required');
        document.getElementById('id_ruangan').value = '';
        document.getElementById('link_meeting').setAttribute('required', 'required');
      } else {
        ruanganField.classList.remove('d-none');
        linkField.classList.add('d-none');
        document.getElementById('id_ruangan').setAttribute('required', 'required');
        document.getElementById('link_meeting').removeAttribute('required');
        document.getElementById('link_meeting').value = '';
      }
    }

    // jalankan saat pertama kali halaman load
    toggleTipe();

    // jalankan saat ada perubahan select
    tipe.addEventListener('change', toggleTipe);
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
