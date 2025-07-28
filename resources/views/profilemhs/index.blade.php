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
      <a href="/profilemhs" class="menu active">
        <div class="menu-left">
          <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
        </div>
      </a>
      <a href="/formulirlayananakademikmhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-file-earmark-text"></i> <span> Formulir Layanan Akademik </span>
        </div>
      </a>
      <a href="" class="menu" id="dropdownToggle">
        <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
        <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/kolokiummhs" class="submenu-link"><i class="bi bi-check2-circle"></i> Kolokium</a>
        <a href="/syaratkolokiummhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Kolokium</a>
        <a href="/seminarmhs" class="submenu-link"><i class="bi bi-calendar-event"></i> Seminar</a>
        <a href="/syaratseminarmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Seminar</a>
        <a href="/komprehensifmhs" class="submenu-link"><i class="bi bi-journal-text"></i> Komprehensif</a>
        <a href="/syaratkomprehensifmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Komprehensif</a>
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
  <h2 class="page-title">Biodata Mahasiswa</h2>

  <div class="biodata-container">
    
    <!-- FOTO MAHASISWA -->
    <div class="photo-section">
      <div class="photo-placeholder">
        <i class="bi bi-image"></i>
      </div>
      <button class="btn-edit-photo">
        <i class="bi bi-pencil-square"></i> Edit Foto
      </button>
    </div>

    <!-- DATA MAHASISWA -->
    <div class="info-section">
      <div class="info-box">
        <div class="info-item">
          <label>Nama</label>
          <input type="text" value="Muzaqi Bagas" readonly>
        </div>
        <div class="info-item">
          <label>NIM</label>
          <form><input type="text" value="J024567XXXX" readonly></form>
        </div>
        <div class="info-item">
          <label>Email</label>
          <input type="text" value="bagas@apps.ipb.ac.id" readonly>
        </div>
        <div class="info-item">
          <label>Tanda Tangan</label>
          <div class="signature-box">
            <img src="{{ asset('img/signature-placeholder.png') }}" alt="Tanda Tangan">
          </div>
        </div>
        <!-- Kalau nanti mau bisa edit -->
          <div class="form-actions">
            <!-- <button type="button" class="btn-edit" id="editBtn">
              <i class="bi bi-pencil-square"></i> Edit
            </button> -->
            <button type="submit" class="btn-save" style="display:none;" id="saveBtn">
              <i class="bi bi-save"></i> Simpan
            </button>
          </div>
      </div>
      
    </div>

    

  </div>
</main>

@endsection

</body>
