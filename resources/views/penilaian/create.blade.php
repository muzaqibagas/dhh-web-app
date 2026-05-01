@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <div class="d-flex align-items-center menu pb-0 mb-0 pt-0 mt-0">
        <h5 class="fw-bold" style="color: #721B29">
          {{ Auth::guard('staff')->user()->nama ?? 'Guest' }}
        </h5>        
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
        <a href="/editpassdosen"
          class="submenu-link {{ Request::is('editpassdosen') ? 'active-submenu' : '' }}">
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
      <div class="card text-start mb-4 p-4" style="background-color:#f3f4f6;">
        <h2 style="margin-top:0; font-size:18px; color:#1e3a8a;">Informasi Mahasiswa</h2>
        <table class="info-table">
            <tr>
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td>{{ $data->mahasiswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $data->mahasiswa->nim ?? '-' }}</td>
            </tr>
            <tr>
                <td>Judul Tugas Akhir</td>
                <td>:</td>
                <td>{{ $judul ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Ujian</td>
                <td>:</td>
                <td>{{ $jenis ?? '-' }}</td>
            </tr>
        </table>
      </div>        
      <div class="card text-start mb-4 p-4">
        <form action="{{ route('penilaian.store') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $data->id }}">
          <input type="hidden" name="jenis" value="{{ $jenis }}">

          @if ($errors->any())
            <div style="margin-bottom:16px; padding:12px; background:#f8d7da; color:#842029; border-radius:8px;">
              <strong>Terjadi kesalahan:</strong>
              <ul style="margin:8px 0 0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <table style="
            width:100%;
            border-collapse:collapse;
            background-color:#ffffff;              
            border-radius:0.375rem;
            overflow:hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);              
          ">
            <thead style="background-color:#1e3a8a; color:#ffffff;">
              <tr>
                <th style="padding:12px 14px; font-size:14px; text-align:left;">No</th>
                <th style="padding:12px 14px; font-size:14px; text-align:left;">Komponen Penilaian</th>
                <th style="padding:12px 14px; font-size:14px; text-align:left;">Bobot (%)</th>
                <th style="padding:12px 14px; font-size:14px; text-align:left;">Nilai (0–100)</th>                    
              </tr>
            </thead>

            <tbody>
              @foreach($rubriks as $index => $rubrik)
              <tr style="background-color:#ffffff;">
                <td style="padding:12px 14px;">{{ $index + 1 }}</td>
                <td style="padding:12px 14px;">{{ $rubrik->nama_kriteria }}</td>
                <td style="padding:12px 14px;">{{ $rubrik->bobot }}</td>
                <td style="padding:12px 14px;">
                  <select name="nilai[{{ $rubrik->id }}]" id="" required>
                    <option value="">Pilih</option>
                    <option value="1" {{ old('nilai.'.$rubrik->id) == '1' ? 'selected' : '' }}>1 - Kurang</option>
                    <option value="2" {{ old('nilai.'.$rubrik->id) == '2' ? 'selected' : '' }}>2 - Cukup</option>
                    <option value="3" {{ old('nilai.'.$rubrik->id) == '3' ? 'selected' : '' }}>3 - Baik</option>
                    <option value="4" {{ old('nilai.'.$rubrik->id) == '4' ? 'selected' : '' }}>4 - Sangat Baik</option>
                  </select>
                </td>
              </tr>
              @endforeach              
            </tbody>
          </table>
          <h2 style="margin-top:0; font-size:18px; color:#1e3a8a;">Catatan / Saran Perbaikan</h2>            
          <textarea
            name="catatan"
            placeholder="Tulis catatan penilaian di sini..."                   
            style="
              width:100%;
              min-height:70px;
              padding:8px;
              font-size:14px;
              resize:vertical;
              border:1px solid #cbd5e1;
              border-radius:6px;
              box-sizing:border-box;
            ">{{ old('catatan') }}</textarea>

          <div style="
            display:flex;
            gap:12px;
            justify-content:flex-end;
            margin-top:20px;"
          >
            <a href="{{ route('dashboarddosen.index') }}" style="
              background-color:#64748b;
              color:#ffffff;
              padding:10px 20px;
              border:none;
              border-radius:6px;
              cursor:pointer;
              font-size:14px;
              text-decoration:none;
              display:inline-block;
            ">
                Batal
            </a>

            <button type="submit" style="
                background-color:#2563eb;
                color:#ffffff;
                padding:10px 20px;
                border:none;
                border-radius:6px;
                cursor:pointer;
                font-size:14px;
            ">
                Simpan Nilai
            </button>
          </div>
        </form>
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
