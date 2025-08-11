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
        $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
        $isKontenActive = Request::is('galeri') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept');
      @endphp

      <!-- BTN TINGKAT AKHIR===================== -->
      <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="tingkatakhir">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span> Tingkat Akhir </span>
        </div>
        <span class="dropdownArrow" data-arrow="tingkatakhir">
          {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="tingkatakhir"
        style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/undangan"
          class="submenu-link {{ Request::is('undangan') ? 'active-submenu' : '' }}">
          <i class="bi bi-envelope-open"></i> Undangan
        </a>
        <a href="/kolokium"
          class="submenu-link {{ Request::is('kolokium') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
        </a>
        <a href="/seminar"
          class="submenu-link {{ Request::is('seminar') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
        </a>
        <a href="/sidang"
          class="submenu-link {{ Request::is('sidang') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Data Pendaftar Sidang
        </a>
      </div>

      <!-- BTN KONTEN ===================== -->
      <a href="#" class="menu {{ $isKontenActive ? 'active' : '' }}" data-dropdown="konten">
        <div class="menu-left">
          <i class="bi bi-collection"></i>
          <span> Konten </span>
        </div>
        <span class="dropdownArrow" data-arrow="konten">
          {!! $isKontenActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="konten"
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
      <a href="/staffdept" class="menu active">
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
      <a href="/admprofile" class="menu">
        <div class="menu-left">
          <i class="bi bi-person-badge"></i> <span> Profil Admin </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
    
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
    </aside>

  <main class="content">
    <h2 class="page-title">Biodata Admin</h2>
    <div class="col-md-9 px-2 d-flex justify-content-center align-items-center gap-5 w-100 mt-4">
      <div class="d-flex flex-column align-items-center align-self-start">
        <div class="rounded-circle overflow-hidden mb-3" style="width: 180px; height: 180px; background-color:#f5f5f5">
          @if($user->foto)
            <img id="preview-image" src="{{ asset('profile/' . $user->foto) }}" alt="" class="w-100 h-100 object-fit-cover">
          @else
            <img id="preview-image" src="{{ asset('img/default.png') }}" alt="" class="w-100 h-100 object-fit-cover">
          @endif
        </div>
              
        <button class="btn-edit-photo">        
          <a href="{{ route('user.edit', Auth::user()->id) }}" class="bi bi-pencil-square text-light text-decoration-none"> Edit Profile</a>
        </button>    
      </div>

      <div class="card p-4 shadow-sm w-100 border-2" style="border:solid #1b2a6d">
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Username</label>
          <input type="text" class="form-control" style="background-color:#f5f5f5" value="{{ Auth::user()->username ?? 'Guest' }}" readonly>
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Nama</label>
          <input type="text" class="form-control" style="background-color:#f5f5f5" value="{{ Auth::user()->nama ?? 'Guest' }}" readonly>
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Email</label>
          <input type="text" class="form-control" style="background-color:#f5f5f5" value="{{ Auth::user()->email ?? 'Guest' }}" readonly>
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Jenis Kelamin</label>
          <input type="text" class="form-control" style="background-color:#f5f5f5" value="{{ Auth::user()->jenis_kelamin ?? 'Guest' }}" readonly>
        </div>        
      </div>
    </div>
  </main>
  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        const output = document.getElementById('preview-image');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</div>
@endsection