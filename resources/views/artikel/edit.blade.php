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
      $isTingkatAkhirActive = 
        Request::is('undangan') || Request::is('undangankolokium') || Request::is('undanganseminar') || Request::is('undangansidang') || 
        Request::is('kolokium') || 
        Request::is('seminar') || 
        Request::is('sidang');
      $isKontenActive = 
        Request::is('kategorigaleri') || Request::is('kategorigaleri/create') || Request::is('kategorigaleri/*/edit') || 
        Request::is('galeri') || Request::is('galeri/create') || Request::is('galeri/*/edit') || 
        Request::is('kategoriartikel') || Request::is('kategoriartikel/create') || Request::is('kategoriartikel/*/edit') || 
        Request::is('artikel') || Request::is('artikel/create') || Request::is('artikel/*/edit') || 
        Request::is('review-alumni') || Request::is('review-alumni/create') || Request::is('review-alumni/*/edit') |
        Request::is('konten-dept') || Request::is('konten-dept/show') || Request::is('konten-dept/*/edit') || 
        Request::is('kontenjenjang') || Request::is('kontenjenjang/show') || Request::is('kontenjenjang/*/edit') || 
        Request::is('mitra'); Request::is('mitra/create') || Request::is('mitra/*/edit') || 
      $isStaffDeptActive = 
        Request::is('kategoristaff') || Request::is('kategoristaff/create') || Request::is('kategoristaff/*/edit') |
        Request::is('staff-dept') || Request::is('staff-dept/create') || Request::is('staff-dept/*/edit') |
        Request::is('ketuadhh') || Request::is('ketuadhh/create') || Request::is('ketuadhh/*/edit');
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
        class="submenu-link {{ Request::is('undangan', 'undangankolokium', 'undanganseminar', 'undangansidang') ? 'active-submenu' : '' }}">
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
        class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit') ? 'active-submenu' : '' }}">
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

<!-- KONTEN -->
  <main class="content">
    <div class="container-fluid">
        <div class="adm-header">
            <h2 class="adm-title">Edit Data Artikel</h2>
        </div>
    </div>
    <div class="container mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <!-- Kolom Kiri: Form -->
              <div class="col-lg-8">

                <!-- Judul -->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                    <label for="judul" class="col-form-label">Judul</label>
                  </div>
                  <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul', $artikel->judul) }}" required>
                  </div>
                </div>

                <!-- Tanggal -->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                    <label for="tanggal" class="col-form-label">Tanggal</label>
                  </div>
                  <div class="col-sm-10">                    
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $artikel->tanggal) }}" required>
                  </div>
                </div>

                <!-- Kategori -->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                  <div class="col-sm-2">
                    <label for="kategori" class="col-form-label">Kategori</label>
                  </div>
                  <div class="col-sm-10">                    
                    <select name="id_kategoriartikel" class="form-select" id="kategori" required>
                      <option value="">Pilih kategori</option>
                      @foreach($kategoriartikel as $kategori)
                        <option value="{{ $kategori->id }}" {{ $artikel->id_kategoriartikel == $kategori->id ? 'selected' : '' }}>
                          {{ $kategori->nama }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- Deskripsi -->
                <div class="text-start row row-cols-1 row-cols-sm-2 align-items-start mb-3">
                  <div class="col-sm-2">
                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                  </div>
                  <div class="col-sm-10">                    
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Deskripsi" required>{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                  </div>
                </div>

              </div>

              <!-- Kolom Kanan: Upload Gambar -->
              <div class="col-lg-4 text-center mb-3">
                <label class="text-start form-label fw-bold d-block">Foto</label>
                <!-- Tempat preview -->
                <div id="preview-container" class="border rounded bg-light d-flex align-items-center justify-content-center mb-2" style="height: 150px;">
                    <i id="preview-icon" class="bi bi-card-image fs-1 text-muted" @if($artikel->foto) style="display:none;" @endif></i>                                        
                    <img id="preview-image" src="{{ $artikel->foto ? asset($artikel->foto) : '' }}" class="img-fluid rounded @if(!$artikel->foto) d-none @endif" style="max-height: 100%; max-width: 100%; object-fit: contain;" />
                </div>
                <!-- Input File -->                    
                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                </div>
              </div>

            <!-- Tombol Simpan -->
            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>
<script>
  document.getElementById('foto').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('preview-image');
    const previewIcon = document.getElementById('preview-icon');

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewImage.classList.remove('d-none');
        previewIcon.classList.add('d-none');
      };

      reader.readAsDataURL(file);
    } else {
        @if($artikel->foto)
          previewImage.src = "{{ asset($artikel->foto) }}";
          previewImage.classList.remove('d-none');
          previewIcon.classList.add('d-none');
        @else
          previewImage.src = '';
          previewImage.classList.add('d-none');
          previewIcon.classList.remove('d-none');
        @endif
    }
  });
</script>
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
@endsection
