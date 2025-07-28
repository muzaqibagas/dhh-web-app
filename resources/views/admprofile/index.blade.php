@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
 <div class="main-container">
    <aside class="sidebar">
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- Untuk aktifin button sub menu ========================= -->
      @php
        $isAkademikActive = Request::is('kurikulum') || Request::is('mata-kuliah');
        $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
        $isKontenActive = Request::is('galeri') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept');
      @endphp

      <!-- BTN AKADEMIK========================= -->
      <a href="#" class="menu  {{ $isAkademikActive ? 'active' : '' }}" id="dropdownToggle">
        <div class="menu-left">
          <i class="bi bi-journal-check"></i>
          <span> Akademik </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow">
          {!! $isAkademikActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div id="dropdownMenu"
        style="margin-left:24px; flex-direction:column; {{ $isAkademikActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/kurikulum"
          class="submenu-link {{ Request::is('kurikulum') ? 'active-submenu' : '' }}">
          <i class="bi bi-archive"></i> Daftar Kurikulum
        </a>
        <a href="/mata-kuliah"
          class="submenu-link {{ Request::is('mata-kuliah') ? 'active-submenu' : '' }}">
          <i class="bi bi-journals"></i> Mata Kuliah
        </a>
      </div>

      <!-- BTN TINGKAT AKHIR===================== -->
      <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" id="dropdownToggle">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span> Tingkat Akhir </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow2">
          {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div id="dropdownMenu"
        style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/undangan"
          class="submenu-link {{ Request::is('undangan') ? 'active-submenu' : '' }}">
          <i class="bi bi-envelope-open"></i> Undangan
        </a>
        <a href="/kolokium"
          class="submenu-link {{ Request::is('kolokium') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Kolokium
        </a>
        <a href="/seminar"
          class="submenu-link {{ Request::is('seminar') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i>  Seminar
        </a>
        <a href="/sidang"
          class="submenu-link {{ Request::is('sidang') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Sidang
        </a>
      </div>

      <!-- BTN KONTEN ===================== -->
      <a href="#" class="menu {{ $isKontenActive ? 'active' : '' }}" id="dropdownToggle">
        <div class="menu-left">
          <i class="bi bi-collection"></i>
          <span> Konten </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow3">
          {!! $isKontenActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div id="dropdownMenu"
        style="margin-left:24px; flex-direction:column; {{ $isKontenActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/galeri"
          class="submenu-link {{ Request::is('galeri') ? 'active-submenu' : '' }}">
          <i class="bi bi-images"></i> Galeri
        </a>
        <a href="/artikel"
          class="submenu-link {{ Request::is('artikel') ? 'active-submenu' : '' }}">
          <i class="bi bi-layout-text-window"></i> Artikel
        </a>
        <a href="/review-alumni"
          class="submenu-link {{ Request::is('review-alumni') ? 'active-submenu' : '' }}">
          <i class="bi bi-star"></i>  Review Alumni
        </a>
        <a href="/konten-dept"
          class="submenu-link {{ Request::is('konten-dept') ? 'active-submenu' : '' }}">
          <i class="bi bi-laptop"></i> Konten Departemen
        </a>
      </div>

      <!-- BTN SDM ===================== -->
      <a href="/admsumberdayamanusia" class="menu">
        <div class="menu-left">
          <i class="bi bi-people-fill"></i> <span> Sumber Daya Manusia </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      
      <!-- PEMBATAS EMAS ===================== -->
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>

      <!-- BTN ADMIN ===================== -->
      <a href="/admprofile" class="menu active">
        <div class="menu-left">
          <i class="bi bi-person-badge"></i> <span> Profil Admin </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
    
      <script>
      // Ambil semua toggle
      const toggles = document.querySelectorAll('.menu[id^="dropdownToggle"]');
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

<main class="content">
  <h2 class="page-title">Biodata Admin</h2>

  <div class="biodata-container">
    
    <!-- FOTO MAHASISWA -->
    <div class="photo-section">
      <div class="admin-photo-placeholder">        
          @if(Auth::user()->foto)
            <img src="{{ asset('profile/' . Auth::user()->foto) }}" alt="" class="bi bi-image">
          @else
            <img src="{{ asset('img/default.png') }}" alt="" class="bi bi-image">
          @endif
      </div>
      <button class="btn-edit-photo">        
        <a href="{{ route('user.edit', Auth::user()->id) }}" class="bi bi-pencil-square text-light text-decoration-none"> Edit Profile</a>
      </button>
    </div>

    <!-- DATA MAHASISWA -->
    <div class="info-section">
      <div class="info-box">
        <div class="info-item">
          <label>Username</label>
          <input type="text" value="{{ Auth::user()->username ?? 'Guest' }}" readonly>
        </div>
        <div class="info-item">
          <label>Nama</label>
          <form><input type="text" value="{{ Auth::user()->nama ?? 'Guest' }}" readonly></form>
        </div>
        <div class="info-item">
          <label>Email</label>
          <input type="text" value="{{ Auth::user()->email ?? 'Guest' }}" readonly>
        </div>
        <div class="info-item">
          <label>jenis kelamin</label>
          <input type="text" value="{{ Auth::user()->jenis_kelamin ?? 'Guest' }}" readonly>
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
