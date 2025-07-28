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
  
  <!-- FORM KOLOKIUM -->

  <div class="kolokium-card">
    <h2 class="page-title">Daftar Sidang Akhir</h2>

    <form>
      <div class="form-group">
        <label>Nama</label>
        <input type="text" placeholder="Masukkan Nama Lengkap">
      </div>

      <div class="form-group">
        <label>NIM</label>
        <input type="text" placeholder="Masukkan NIM">
      </div>

      <div class="form-group">
        <label>Semester</label>
        <input type="text" placeholder="Masukkan Semester">
      </div>

      <div class="form-group">
        <label>Alamat di Bogor</label>
        <input type="text" placeholder="Masukkan Alamat Lengkap">
      </div>

      <div class="form-group">
        <label>Program Studi</label>
        <select>
          <option selected disabled>Pilih Program Studi</option>
          <option>Hasil Hutan</option>
          <option>Teknologi Kayu</option>
        </select>
      </div>

      <div class="form-group">
        <label>Judul Tugas Akhir</label>
        <textarea placeholder="Masukkan Judul"></textarea>
      </div>

      <div class="form-group">
        <label>Dosen Pembimbing 1</label>
        <select>
          <option selected disabled>Pilih Dosen</option>
          <option>Dosen 1</option>
          <option>Dosen 2</option>
        </select>
      </div>

      <div class="form-group">
        <label>Dosen Pembimbing 2</label>
        <select>
          <option selected disabled>Pilih Dosen</option>
          <option>Dosen 1</option>
          <option>Dosen 2</option>
        </select>
      </div>

      <div class="form-group">
        <label>Hari/Tanggal Sidang</label>
        <input type="date">
      </div>

      <div class="form-group">
        <label>Waktu Sidang</label>
        <input type="time">
      </div>

      <div class="form-group">
        <label>Tempat Sidang</label>
        <input type="text" placeholder="Masukkan Ruangan">
      </div>

      <div class="form-group">
        <label>Ketua Sidang</label>
        <div class="form-static">[Diisi oleh akademik]</div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-submit">Submit</button>
      </div>
    </form>
  </div>
</main>

@endsection