@extends('layouts.appss')

@section('content')
<!-- SIDEBAR -->
 <div class="main-container">
    <aside class="sidebar">
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- BTN AKADEMIK========================= -->
      <a href="" class="menu" id="dropdownToggle">
        <div class="menu-left">
          <i class="bi bi-journal-check"></i> 
          <span> Akademik </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admdaftarkurikulum" class="submenu-link"><i class="bi bi-archive"></i> Daftar Kurikulum</a>
        <a href="/admdaftarkurikulum" 
          class="submenu-link {{ Request::is('admdaftarkurikulum') ? 'active' : '' }}">
          <i class="bi bi-archive"></i> Daftar Kurikulum
        </a>
        <a href="/admmatakuliah" 
          class="submenu-link {{ Request::is('admmatakuliah') ? 'active' : '' }}">
          <i class="bi bi-archive"></i> Mata Kuliah
        </a>
      </div>

      <!-- BTN TINGKAT AKHIR===================== -->
      <a href="" class="menu" id="dropdownToggle2">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span>Tingkat Akhir</span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow2">&#9650;</span>
      </a>
      <div id="dropdownMenu2" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admsurat undangan" class="submenu-link"><i class="bi bi-envelope-open"></i> Surat Undangan</a>
        <a href="/admdatapendaftarkolokium" class="submenu-link"><i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium</a>
        <a href="/admdatapendaftarseminar" class="submenu-link"><i class="bi bi-calendar-event"></i> Data Pendaftar Seminar</a>
        <a href="/admdatapendaftarsidang" class="submenu-link"><i class="bi bi-journal-text"></i> Data Pendaftar Sidang</a>
        <a href="/admpengumuman" class="submenu-link"><i class="bi bi-megaphone"></i> Pengumuman</a>
      </div>

      <!-- BTN KONTEN ===================== -->
      <a href="" class="menu" id="dropdownToggle3">
        <div class="menu-left">
          <i class="bi bi-collection"></i> 
          <span> Konten </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow3">&#9650;</span>
      </a>
      <div id="dropdownMenu3" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admkategori" class="submenu-link"><i class="bi bi-info-circle"></i> Kategori</a>
        <a href="/admgaleri" class="submenu-link"><i class="bi bi-images"></i> Galeri</a>
        <a href="/admartikel" class="submenu-link"><i class="bi bi-layout-text-window"></i> Artikel </a>
        <a href="/admreviewalumni" class="submenu-link"><i class="bi bi-star"></i> Review Alumni </a>
        <a href="/admkontendepart" class="submenu-link"><i class="bi bi-laptop"></i> Konten Departemen </a>
      </div>
      <a href="/admsumberdayamanusia" class="menu">
        <div class="menu-left">
          <i class="bi bi-people-fill"></i> <span> Sumber Daya Manusia </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <a href="/admprofile" class="menu">
        <div class="menu-left">
          <i class="bi bi-person-badge"></i> <span> Profil Admin </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
    
    <script>
      // Ambil semua toggle
      const toggles = document.querySelectorAll('.menu[id^="dropdownToggle"]');

      toggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
          e.preventDefault();

          // Ambil id tombol yang diklik (misal dropdownToggle2 -> jadi dropdownMenu2)
          const toggleId = this.id;
          const menuId = toggleId.replace('dropdownToggle', 'dropdownMenu');
          const arrowId = toggleId.replace('dropdownToggle', 'dropdownArrow');

          const menu = document.getElementById(menuId);
          const arrow = document.getElementById(arrowId);

          const isOpen = menu.style.display === 'flex';

          // 🔹 TUTUP SEMUA dropdown terlebih dulu
          document.querySelectorAll('[id^="dropdownMenu"]').forEach(m => m.style.display = 'none');
          document.querySelectorAll('[id^="dropdownArrow"]').forEach(a => a.innerHTML = '&#9650;');

          // 🔹 Kalau tadi TERTUTUP, buka menu yg diklik
          if (!isOpen) {
            menu.style.display = 'flex';
            arrow.innerHTML = '&#9660;';
          }
        });
      });
    </script>

  </aside>
<!-- MAIN CONTENT -->
  <main class="content">
    <div class="adm-header">
        <h2 class="adm-title">Daftar Kurikulum</h2>
        <button class="adm-btn-add">
          <i class="bi bi-plus"></i> Tambah Data
        </button>
    </div>
    <div class="adm-card">
      <!-- JUDUL -->
      

      <!-- TABEL -->
      <div class="adm-table-container">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Jenjang</th>
              <th>Nama Kurikulum</th>
              <th>Tahun</th>
              <th>Kompetensi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>S1</td>
              <td>Kurikulum Berbasis Teknologi.</td>
              <td>2013</td>
              <td>Kompetensi Mayor</td>
              <td class="adm-action">
                <button class="adm-btn-edit"><i class="bi bi-pencil-square"></i></button>
                <button class="adm-btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>S1</td>
              <td>Kurikulum Berbasis Teknologi.</td>
              <td>2013</td>
              <td>Kompetensi Minor</td>
              <td class="adm-action">
                <button class="adm-btn-edit"><i class="bi bi-pencil-square"></i></button>
                <button class="adm-btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>S1</td>
              <td>Kurikulum Berbasis Keterampilan (KBK)</td>
              <td>2025</td>
              <td>-</td>
              <td class="adm-action">
                <button class="adm-btn-edit"><i class="bi bi-pencil-square"></i></button>
                <button class="adm-btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>S2</td>
              <td>Kurikulum Berbasis Proyek</td>
              <td>2009</td>
              <td>Kompetensi Mayor</td>
              <td class="adm-action">
                <button class="adm-btn-edit"><i class="bi bi-pencil-square"></i></button>
                <button class="adm-btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>S3</td>
              <td>Kurikulum Berbasis Kompetensi (KBK)</td>
              <td>2011</td>
              <td>Kompetensi Mayor</td>
              <td class="adm-action">
                <button class="adm-btn-edit"><i class="bi bi-pencil-square"></i></button>
                <button class="adm-btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>
@endsection