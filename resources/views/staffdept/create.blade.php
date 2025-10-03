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


  <!-- MAIN KONTEN -->
  <main class="content">
    <div class="container-fluid mt-4">
      <div class="adm-header">
        <h2 class="adm-title">Create Staff Departemen</h2>
      </div>
      <div class="card shadow-sm">
        <div class="card-body">
          <form action="{{ route('staffdept.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              {{-- NAMA --}}
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label text-start">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Staff" required>
                </div>
              </div>

              {{-- NIP --}}
              <div class="row mb-3">
                <label for="nip" class="col-sm-2 col-form-label text-start">NIP</label>
                <div class="col-sm-10">
                  <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" required>
                </div>
              </div>

              {{-- FOTO --}}
              <div class="row mb-3">
                <label for="foto" class="col-sm-2 col-form-label text-start">Foto</label>
                <div class="col-sm-10">
                  <input type="file" name="foto" class="form-control" id="foto" required>
                </div>
              </div>

              {{-- KATEGORI --}}
              <div class="row mb-3">
                <label for="kategori" class="col-sm-2 col-form-label text-start">Kategori</label>
                <div class="col-sm-10">
                  <select name="id_kategoristaff" id="kategori" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoriStaffs as $kategori)
                      <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- DIVISI --}}
              <div class="row mb-3">
                <label for="divisi" class="col-sm-2 col-form-label text-start">Divisi</label>
                <div class="col-sm-10">
                  <select name="id_divisi" id="divisi" class="form-select" required>
                    <option value="">Pilih divisi</option>
                    @foreach ($divisis as $divisi)
                      <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- JABATAN --}}
              <div class="row mb-3">
                <label for="jabatan" class="col-sm-2 col-form-label text-start">Jabatan</label>
                <div class="col-sm-10">
                  <select name="id_jabatan" id="jabatan" class="form-select" required>
                    <option value="">Pilih jabatan</option>
                    @foreach ($jabatans as $jabatan)
                      <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- TANGGAL --}}
              <div class="row mb-3">
                  <label for="tanggal_lahir" class="col-sm-2 col-form-label text-start">Tanggal Lahir</label>
                <div class="col-sm-10">
                  <input type="date" 
                        name="tanggal_lahir" 
                        id="tanggal_lahir" 
                        class="form-control" 
                        value="{{ old('tanggal_lahir', $staffDept->tanggal_lahir ?? '') }}"
                        required>
                </div>
              </div>  

              {{-- EMAIL --}}
              <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label text-start">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                </div>
              </div>

              {{-- SCOPUS --}}
              <div class="row mb-3">
                <label for="scopus" class="col-sm-2 col-form-label text-start">Scopus</label>
                <div class="col-sm-10">
                  <input type="text" name="scopus" class="form-control" id="scopus" placeholder="Masukkan link Scopus" required>
                </div>
              </div>

              {{-- SINTA --}}
              <div class="row mb-3">
                <label for="sinta" class="col-sm-2 col-form-label text-start">Sinta</label>
                <div class="col-sm-10">
                  <input type="text" name="sinta" class="form-control" id="sinta" placeholder="Masukkan link Sinta" required>
                </div>
              </div>

              {{-- GOOGLE SCHOLAR --}}
              <div class="row mb-3">
                <label for="google_scholar" class="col-sm-2 col-form-label text-start">Google Scholar</label>
                <div class="col-sm-10">
                  <input type="text" name="google_scholar" class="form-control" id="google_scholar" placeholder="Masukkan link Google Scholar" required>
                </div>
              </div>

              {{-- WEBSITE --}}
              <div class="row mb-3">
                <label for="website" class="col-sm-2 col-form-label text-start">Website</label>
                <div class="col-sm-10">
                  <input type="text" name="website" class="form-control" id="website" placeholder="Masukkan link website pribadi" required>
                </div>
              </div>

              {{-- RESEARCH GATE --}}
              <div class="row mb-3">
                <label for="researchgate" class="col-sm-2 col-form-label text-start">ResearchGate</label>
                <div class="col-sm-10">
                  <input type="text" name="researchgate" class="form-control" id="researchgate" placeholder="Masukkan link ResearchGate" required>
                </div>
              </div>

              {{-- KEAHLIAN --}}
              <div class="row mb-3">
                <label for="keahlian" class="col-sm-2 col-form-label text-start">Keahlian</label>
                <div class="col-sm-10">
                  <textarea name="keahlian" class="form-control" id="keahlian" rows="3" placeholder="Masukkan bidang keahlian" required></textarea>
                </div>
              </div>

              {{-- LINK PUBLIKASI --}}
              <div class="row mb-3">
                <label for="publikasi" class="col-sm-2 col-form-label text-start">Link Publikasi</label>
                <div class="col-sm-10">
                  <textarea name="publikasi" class="form-control" id="publikasi" rows="3" placeholder="Masukkan link publikasi" required></textarea>
                </div>
              </div>

              {{-- RIWAYAT PENDIDIKAN --}}
              <div class="row mb-3">
                <label for="riwayat_pendidikan" class="col-sm-2 col-form-label text-start">Riwayat Pendidikan</label>
                <div class="col-sm-10">
                  <textarea name="riwayat_pendidikan" class="form-control" id="riwayat_pendidikan" rows="3" placeholder="Masukkan riwayat pendidikan" required></textarea>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="row">
                <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>

          </form>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection