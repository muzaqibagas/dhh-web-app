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
      <a href="#" class="menu{{ $isAkademikActive ? 'active' : '' }}" data-dropdown="akademik">
        <div class="menu-left">
          <i class="bi bi-journal-check"></i>
          <span> Akademik </span>
        </div>
        <span class="dropdownArrow" data-arrow="akademik">
          {!! $isAkademikActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="akademik"
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
      <a href="#" class="menu active{{ $isKontenActive ? 'active' : '' }}" data-dropdown="konten">
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
      <a href="/staffdept" class="menu">
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
    
<!-- MAIN CONTENT -->
<main class="content">
<div class="container-fluid">
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
              <input type="text" name="judul" id="judul" class="form-control" placeholder="Tulis judul.." required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tipe" class="text-start col-sm-2 col-form-label">Tipe</label>
            <div class="col-sm-10">
              <select name="tipe" id="tipe" class="form-select" required>
                <option value="">Pilih tipe</option>
                <option value="foto">Foto</option>
                <option value="video">Video</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="kategori" class="text-start col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select name="kategori" id="kategori" class="form-select" required>
                <option value="">Pilih kategori</option>
                <option value="kegiatan">Kegiatan</option>
                <option value="prestasi">Prestasi</option>
                <option value="umum">Umum</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tanggal" class="text-start col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3" id="file-upload-wrapper" style="display: none;">
            <label for="file" class="text-start col-sm-2 col-form-label">Upload</label>
            <div class="col-sm-10">
              <input type="file" name="file" id="file" class="form-control">
              <div id="preview" class="mt-3"></div>
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
  document.getElementById('tipe').addEventListener('change', function() {
    const fileWrapper = document.getElementById('file-upload-wrapper');
    const preview = document.getElementById('preview');
    fileWrapper.style.display = this.value ? 'flex' : 'none';
    preview.innerHTML = '';
    document.getElementById('file').value = null;
  });

  document.getElementById('file').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';

    const file = e.target.files[0];
    if (file) {
      const type = file.type;
      const reader = new FileReader();
      reader.onload = function(event) {
        if (type.startsWith('image/')) {
          const img = document.createElement('img');
          img.src = event.target.result;
          img.className = 'img-thumbnail';
          img.style.maxHeight = '200px';
          preview.appendChild(img);
        } else if (type.startsWith('video/')) {
          const video = document.createElement('video');
          video.src = event.target.result;
          video.controls = true;
          video.className = 'w-100';
          video.style.maxHeight = '300px';
          preview.appendChild(video);
        } else {
          preview.innerText = 'Format tidak didukung.';
        }
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection


<!-- 
    <h1>Tambah Galeri</h1>

    <form action="{{ route('galeri.store') }}" method="POST">
        @csrf

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul"><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal"><br>

        <label for="tipe">Tipe:</label>
        <select name="tipe" id="tipe" onchange="toggleMediaInput()">        
            <option value="gambar">Gambar</option>
            <option value="video">Video</option>
        </select><br>

        <div id="gambar-input">
            <label for="gambar">Gambar (nama file):</label>
            <input type="file" name="gambar" id="gambar"><br>
        </div>

        <div id="video-input" style="display: none;">
            <label for="video">Video (link):</label>
            <input type="text" name="video" id="video"><br>        
        </div>

        <label for="id_user">User ID:</label>
        <input type="number" name="id_user" id="id_user"><br>

        <label for="id_kategori">Kategori:</label>
        <select name="id_kategori" id="id_kategori">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
            @endforeach
        </select><br>


        <button type="submit">Simpan</button>
    </form>

    <script>
        function toggleMediaInput() {
            const tipe = document.getElementById('tipe').value;
            const gambarInput = document.getElementById('gambar-input');
            const videoInput = document.getElementById('video-input');

            if (tipe === 'gambar') {
                gambarInput.style.display = 'block';
                videoInput.style.display = 'none';
            } else if (tipe === 'video') {
                gambarInput.style.display = 'none';
                videoInput.style.display = 'block';
            }
        }

        // Jalankan sekali saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', toggleMediaInput);
    </script> -->

