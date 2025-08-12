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

    <!-- MAIN CONTENT -->
    <main class="content">

        <div class="syarat-card">
            <h2 class="page-title">Persyaratan Kolokium</h2>

            <ol class="syarat-list">
                <li><b>Batas Waktu Pengurusan Administrasi</b><br>
                    Pengurusan administrasi kolokium tugas akhir paling lambat dilakukan 4 hari kerja sebelum pelaksanaan kolokium (H-4).
                </li>
                <li><b>Formulir Pendaftaran Kolokium</b><br>
                    Mahasiswa diminta mengisi dan mengunggah foto formulir pendaftaran kolokium yang telah ditandatangani oleh dosen pembimbing (dapat menggunakan Digsign IPB).
                </li>
                <li><b>Bukti Telah Menyelesaikan Minimal 110 SKS</b><br>
                    Lampirkan bukti jumlah SKS yang telah ditempuh, dengan total minimal 110 SKS.
                </li>
                <li><b>Status Mahasiswa Aktif (Telah Melunasi SPP)</b><br>
                    Unggah bukti pembayaran atau tangkapan layar status mahasiswa aktif (TF/SPP Lunas) dari sistem akademik.
                </li>
                <li><b>Makalah Kolokium</b><br>
                    Unggah makalah kolokium dalam bentuk foto atau hasil scan yang jelas.
                </li>
                <li><b>Map Folio (4 Buah)</b><br>
                    Siapkan dan kumpulkan 4 buah map folio secara fisik ke bagian administrasi jurusan setelah semua dokumen diunggah secara daring.
                </li>
            </ol>

            <div class="upload-section">
                <h4><i class="bi bi-upload"></i> Form Upload Dokumen</h4>
                <div class="form-group">
                    <label>Upload Formulir Pendaftaran Kolokium</label>
                    <input type="file">
                </div>

                <div class="form-group">
                    <label>Upload Bukti TF / SPP Lunas</label>
                    <input type="file">
                </div>

                <div class="form-group">
                    <label>Upload Bukti Kehadiran Kolokium</label>
                    <input type="file">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Simpan</button>
                </div>
            </div>

        </div>

    </main>
</div>
@endsection
