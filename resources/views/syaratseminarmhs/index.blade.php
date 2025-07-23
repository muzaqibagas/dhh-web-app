@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
    <div class="main-container">
    <aside class="sidebar">
      <a href="#" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      
      <a href="/dashboardmhs" class="menu"><i class="bi bi-house-door-fill"></i> Beranda</a>
      <a href="/profilemhs" class="menu"><i class="bi bi-person"></i> Profil Mahasiswa</a>
      <a href="/formulirlayananakademikmhs" class="menu"><i class="bi bi-file-earmark-text"></i> Formulir Layanan Akademik</a>
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


      <a href="#" class="menu"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a>

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
            <h2 class="page-title">Persyaratan Seminar</h2>

            <ol class="syarat-list">
                <li><b>Batas Waktu</b><br>
                    Pengurusan administrasi seminar tugas akhir paling lambat dilakukan 4 hari kerja sebelum pelaksanaan seminar (H-4). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar tidak melewati batas waktu yang telah ditentukan.
                </li>
                <li><b>Formulir Pendaftaran Seminar</b><br>
                    Mahasiswa wajib mengisi formulir pendaftaran seminar di halaman Seminar. Setelah diisi, formulir tersebut harus ditandatangani oleh dosen pembimbing (dapat menggunakan Digsign IPB) dan kemudian diunggah kembali melalui halaman ini. Setelah diterima, formulir akan disahkan oleh Ketua Departemen melalui bagian Tata Usaha (TU).
                </li>
                <li><b>Jumlah Kehadiran Seminar</b><br>
                    Mahasiswa hanya dapat mendaftar seminar setelah memenuhi jumlah minimal kehadiran, yaitu 10 kali seminar di Departemen Hasil Hutan dan 5 kali seminar di luar Departemen Hasil Hutan. Bukti kehadiran dapat diminta dari bagian administrasi.
                </li>
                <li><b>Telah Menyelesaikan Seluruh Mata Kuliah</b><br>
                    Mahasiswa harus membawa dokumen bukti telah menyelesaikan seluruh mata kuliah wajib, termasuk Kolokium, dengan jumlah minimal 137 SKS dan memiliki IPK keseluruhan minimal 2,00 tanpa nilai E.   
                </li>
                <li><b>Bukti Pelunasan SPP</b><br>
                    Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan jelas.
                </li>
                <li><b>Dokumen yang Diserahkan ke TU</b><br>
                    Selain dokumen yang diunggah secara daring, mahasiswa juga harus menyerahkan secara langsung ke bagian TU beberapa dokumen berikut:<br>
                    - Bukti penyerahan proposal penelitian<br>
                    - Makalah seminar (1 eksemplar) yang telah diparaf oleh dosen pembimbing<br>
                    - 4 buah map folio<br>
                    - 10 buah amplop putih
                </li>
            </ol>

            <div class="upload-section">
                <h4><i class="bi bi-upload"></i> Form Upload Dokumen</h4>
                <div class="form-group">
                    <label>Upload Formulir Pendaftaran Seminar</label>
                    <input type="file">
                </div>

                <div class="form-group">
                    <label>Upload Bukti TF / SPP Lunas</label>
                    <input type="file">
                </div>

                <div class="form-group">
                    <label>Upload Bukti Kehadiran Seminar</label>
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