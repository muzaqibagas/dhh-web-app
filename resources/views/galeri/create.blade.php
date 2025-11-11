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
      $isDashboardActive = Request::is('dashboardadm');

      $isAdminProfileActive = Request::is('admprofile') || Request::is('user/*/edit') || Request::is('editpassadm') || Request::is('logoutadmprofile');

      
      $isTingkatAkhirActive = 
        Request::is('syaratkolokiummhs') || Request::is('syaratkolokiummhs*') ||
        Request::is('syaratseminarmhs') || Request::is('syaratseminarmhs*') ||
        Request::is('syaratkomprehensifmhs') || Request::is('syaratkomprehensifmhs*');

      $isKontenActive = 
          Request::is('kategorigaleri*') ||
          Request::is('galeri*') ||
          Request::is('kategoriartikel*') ||
          Request::is('artikel*') ||
          Request::is('review-alumni*') ||
          Request::is('konten-dept*') ||
          Request::is('kontenjenjang*') ||
          Request::is('mitra*');

      $isStaffDeptActive = 
          Request::is('kategoristaff*') ||
          Request::is('staff-dept*') ||
          Request::is('ketuadhh*');
    @endphp

        <!-- BTN Dashboard ===================== -->
    <a href="/dashboardadm" class="menu {{ $isDashboardActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-graph-up"></i> <span> Dashboard </span>
      </div>
      <span class="dropdownArrow"></span>
    </a>

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
      <a href="/syaratkolokiummhs"
        class="submenu-link {{ Request::is('syaratkolokiummhs', 'syaratkolokiummhs/*') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
      </a>
      <a href="/syaratseminarmhs"
        class="submenu-link {{ Request::is('syaratseminarmhs', 'syaratseminarmhs/*') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
      </a>
      <a href="/syaratkomprehensifmhs"
        class="submenu-link {{ Request::is('syaratkomprehensifmhs') ? 'active-submenu' : '' }}">
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
      <a href="/kategorigaleri"
        class="submenu-link {{ Request::is('kategorigaleri', 'kategorigaleri/create', 'kategorigaleri/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Galeri
      </a>
      <a href="/galeri"
        class="submenu-link {{ Request::is('galeri', 'galeri/create', 'galeri/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-images"></i> Galeri
      </a>
      <a href="/kategoriartikel"
        class="submenu-link {{ Request::is('kategoriartikel', 'kategoriartikel/create', 'kategoriartikel/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Artikel
      </a>
      <a href="/artikel"
        class="submenu-link {{ Request::is('artikel', 'artikel/create', 'artikel/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-layout-text-window"></i> Artikel
      </a>
      <a href="/review-alumni"
        class="submenu-link {{ Request::is('review-alumni', 'review-alumni/create', 'review-alumni/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-star"></i>  Review Alumni
      </a>
      <a href="/konten-dept"
        class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit', 'konten-dept/create') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit', 'kontenjenjang/create') ? 'active-submenu' : '' }}">
        <i class="bi bi-house-door"></i> Konten Jenjang
      </a>
      <a href="/mitra"
        class="submenu-link {{ Request::is('mitra', 'mitra/create', 'mitra/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-person-check"></i> Mitra
      </a>
    </div>

    <!-- BTN SDM ===================== -->
    <a href="#" class="menu {{ $isStaffDeptActive ? 'active' : '' }}" data-dropdown="staffdept">
      <div class="menu-left">
        <i class="bi bi-people-fill"></i>
        <span> Sumber Daya Manusia </span>
      </div>
      <span class="dropdownArrow" data-arrow="staffdept">
        {!! $isStaffDeptActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="staffdept"
      style="margin-left:24px; flex-direction:column; {{ $isStaffDeptActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/kategoristaff"
        class="submenu-link {{ Request::is('kategoristaff', 'kategoristaff/create', 'kategoristaff/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-envelope-open"></i> Kategori Staff Departemen
      </a>
      <a href="/staff-dept"
        class="submenu-link {{ Request::is('staff-dept', 'staff-dept/create', 'staff-dept/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Staff Departemen
      </a>
      <a href="/ketuadhh"
        class="submenu-link {{ Request::is('ketuadhh', 'ketuadhh/create', 'ketuadhh/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Ketua DHH
      </a>
    </div>
    
    <!-- PEMBATAS EMAS ===================== -->
    <a href="" class="menu-image-only">
      <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
    </a>

    <!-- BTN ADMIN ===================== -->
    <a href="#" class="menu {{ $isAdminProfileActive ? 'active' : '' }}" data-dropdown="admprofile">
      <div class="menu-left">
        <i class="bi bi-person-badge"></i>
        <span> Profil Admin </span>
      </div>
      <span class="dropdownArrow" data-arrow="admprofile">
        {!! $isAdminProfileActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="admprofile"
      style="margin-left:24px; flex-direction:column; {{ $isAdminProfileActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/admprofile"
        class="submenu-link {{ Request::is('admprofile', 'user/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-person-workspace"></i> Detail Profil Admin
      </a>
      <a href="/editpassadm"
        class="submenu-link {{ Request::is('editpassadm') ? 'active-submenu' : '' }}">
        <i class="bi bi-gear-wide-connected"></i> Edit Password
      </a>
      <a href="/logoutadmprofile"
        class="submenu-link {{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
        <i class="bi bi-box-arrow-right"></i> Log Out
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
    
<!-- MAIN CONTENT -->
<main class="content">
<div class="container-fluid mt-4">
  <div class="adm-header">
    <h2 class="adm-title">Tambah Data Galeri</h2>
  </div> 
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm p-4">
        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row mb-3">
            <label for="judul" class="text-start col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul..." required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tipe" class="text-start col-sm-2 col-form-label">Tipe</label>
            <div class="col-sm-10">
              <select name="tipe" id="tipe" class="form-select" required>
                <option value="">Pilih tipe</option>
                <option value="gambar">Gambar</option>
                <option value="video">Video</option>  
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="kategori" class="text-start col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select name="id_kategorigaleri" id="kategori" class="form-select" required>
                <option value="">Pilih kategori</option>
                @foreach ($kategorigaleri as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tanggal" class="text-start col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
          </div>          

          <div class="row mb-3" id="gambar-upload-wrapper" style="display: none;">
            <label for="gambar" class="text-start col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10">
              <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
              <div id="preview-gambar" class="mt-3"></div>
            </div>
          </div>

          <!-- Untuk Video -->
          <div class="row mb-3" id="video-upload-wrapper" style="display: none;">
            <label for="video_file" class="text-start col-sm-2 col-form-label">Upload Video</label>
            <div class="col-sm-10">
              <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*">
              <div id="preview-video" class="mt-3"></div>
            </div>
          </div>

          <div class="row mb-3" id="url-upload-wrapper" style="display: none;">
            <label for="video_url" class="text-start col-sm-2 col-form-label">URL Video</label>
            <div class="col-sm-10">
              <input type="url" name="video_url" id="video_url" class="form-control" placeholder="https://youtube.com/..." >
              
              <div id="preview-url" class="mt-3"></div>
            </div>
          </div>


          <div class="text-end">
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const tipeSelect = document.getElementById('tipe');

  // Input
  const gambarInput = document.getElementById('gambar');
  const videoFileInput = document.getElementById('video_file');
  const videoUrlInput = document.getElementById('video_url');

  // Wrapper
  const gambarWrapper = document.getElementById('gambar-upload-wrapper');
  const videoWrapper = document.getElementById('video-upload-wrapper');
  const urlWrapper = document.getElementById('url-upload-wrapper');

  // Preview
  const previewGambar = document.getElementById('preview-gambar');
  const previewVideo = document.getElementById('preview-video');
  const previewUrl = document.getElementById('preview-url');

  function resetInputs() {
    gambarInput.value = '';
    videoFileInput.value = '';
    videoUrlInput.value = '';
    previewGambar.innerHTML = '';
    previewVideo.innerHTML = '';
    previewUrl.innerHTML = '';
  }

  function updateInputState() {
    const tipe = tipeSelect.value;

    if (tipe === 'gambar') {
      gambarWrapper.style.display = 'flex';
      videoWrapper.style.display = 'none';
      urlWrapper.style.display = 'none';

      gambarInput.required = true;
      videoFileInput.required = false;
      videoUrlInput.required = false;

      videoFileInput.disabled = true;
      videoUrlInput.disabled = true;
    } else if (tipe === 'video') {
      gambarWrapper.style.display = 'none';
      videoWrapper.style.display = 'flex';
      urlWrapper.style.display = 'flex';

      gambarInput.required = false;
      videoFileInput.disabled = false;
      videoUrlInput.disabled = false;

      enforceVideoRule(); // cek apakah salah satu wajib diisi
    } else {
      gambarWrapper.style.display = 'none';
      videoWrapper.style.display = 'none';
      urlWrapper.style.display = 'none';
    }

    resetInputs();
  }

  tipeSelect.addEventListener('change', updateInputState);
  updateInputState();

  // Wajib isi salah satu (file video atau url)
  function enforceVideoRule() {
    if (tipeSelect.value === 'video') {
      if (videoFileInput.value) {
        videoUrlInput.required = false;
        videoFileInput.required = false;
        videoUrlInput.disabled = true;
      } else if (videoUrlInput.value) {
        videoFileInput.required = false;
        videoUrlInput.required = false;
        videoFileInput.disabled = true;
      } else {
        videoFileInput.required = true;
        videoUrlInput.required = true;
        videoFileInput.disabled = false;
        videoUrlInput.disabled = false;
      }
    }
  }

  videoFileInput.addEventListener('input', enforceVideoRule);
  videoUrlInput.addEventListener('input', enforceVideoRule);

  // Preview gambar
  gambarInput.addEventListener('change', function(e) {
    previewGambar.innerHTML = '';
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(event) {
        const img = document.createElement('img');
        img.src = event.target.result;
        img.className = 'img-thumbnail';
        img.style.maxHeight = '200px';
        previewGambar.appendChild(img);
      };
      reader.readAsDataURL(file);
    }
  });

  // Preview video file
  videoFileInput.addEventListener('change', function(e) {
    previewVideo.innerHTML = '';
    const file = e.target.files[0];
    if (file && file.type.startsWith('video/')) {
      const video = document.createElement('video');
      video.src = URL.createObjectURL(file);
      video.controls = true;
      video.className = 'w-100';
      video.style.maxHeight = '300px';
      previewVideo.appendChild(video);
    }
    enforceVideoRule();
  });

  // Preview video URL (YouTube embed)
  videoUrlInput.addEventListener('input', function(e) {
    previewUrl.innerHTML = '';
    const url = e.target.value;
    if (url) {
      let embedUrl = url;
      let videoId = null;

      if (url.includes('youtube.com/watch?v=')) {
        videoId = url.split('v=')[1].split('&')[0];
      } else if (url.includes('youtu.be/')) {
        videoId = url.split('youtu.be/')[1].split('?')[0];
      }

      if (videoId) {
        embedUrl = 'https://www.youtube.com/embed/' + videoId;
      }

      const iframe = document.createElement('iframe');
      iframe.width = '320';
      iframe.height = '180';
      iframe.src = embedUrl;
      iframe.frameBorder = '0';
      iframe.allowFullscreen = true;
      previewUrl.appendChild(iframe);
    }
    enforceVideoRule();
  });
</script>

@endsection