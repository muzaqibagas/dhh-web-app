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
      
      $isRecapdataActive = Request::is('recapdata*');

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

    <!-- BTN RECAP DATA ===================== -->
    <a href="/recapdata" class="menu {{ $isRecapdataActive ? 'active' : '' }}">
      <div class="menu-left">
        <i class="bi bi-database-check"></i> <span> Recap Data </span>
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
        class="submenu-link {{ Request::is('konten-dept/*', 'konten-dept/show', 'konten-dept/*/edit', 'konten-dept/create') ? 'active-submenu' : '' }}">
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
      <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
          @csrf
          <button type="submit" class="submenu-link w-100 text-start{{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
              <i class="bi bi-box-arrow-right"></i> Log Out
          </button>
      </form>
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
      <h2 class="adm-title">Edit Staff Departemen</h2>
    </div>
     @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session('info') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('staffdept.update', $staffDept->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- {{-- NAMA --}} -->
          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label text-start">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" id="nama" 
                     value="{{ old('nama', $staffDept->nama) }}" placeholder="Masukkan Nama Staff" required>
            </div>
          </div>

          <!-- {{-- NIP --}} -->
          <div class="row mb-3">
            <label for="nip" class="col-sm-2 col-form-label text-start">NIP</label>
            <div class="col-sm-10">
              <input type="text" name="nip" class="form-control" id="nip" 
                     value="{{ old('nip', $staffDept->nip) }}" placeholder="Masukkan NIP" required>
            </div>
          </div>

          <!-- {{-- FOTO --}} -->
          <div class="row mb-3">
              <label for="foto" class="col-sm-2 col-form-label text-start">Foto</label>
              <div class="col-sm-10">
                  <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                    <div class="d-flex justify-content-center">
                      <!-- Preview foto lama jika ada -->
                      <img
                        id="preview-foto"
                        src="{{ $staffDept->foto ? asset($staffDept->foto) : '' }}"
                        class="img-thumbnail mt-2 {{ $staffDept->foto ? '' : 'd-none' }}"
                        width="150"
                        alt="Foto">
                    </div>
              </div>
          </div>

          <!-- {{-- KATEGORI --}} -->
          <div class="row mb-3">
            <label for="kategori" class="col-sm-2 col-form-label text-start">Kategori</label>
            <div class="col-sm-10">
              <select name="id_kategoristaff" id="kategori" class="form-select" required>
                <option value="">Pilih kategori</option>
                @foreach ($kategoriStaffs as $kategori)
                  <option value="{{ $kategori->id }}" 
                          {{ old('id_kategoristaff', $staffDept->id_kategoristaff) == $kategori->id ? 'selected' : '' }}>
                          {{ $kategori->nama }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- {{-- DIVISI --}} -->
          <div class="row mb-3">
            <label for="divisi" class="col-sm-2 col-form-label text-start">Divisi</label>
            <div class="col-sm-10">
              <select name="id_divisi" id="divisi" class="form-select" required>
                <option value="">Pilih divisi</option>
                @foreach ($divisis as $divisi)
                  <option value="{{ $divisi->id }}" 
                          {{ old('id_divisi', $staffDept->id_divisi) == $divisi->id ? 'selected' : '' }}>
                          {{ $divisi->nama }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- {{-- JABATAN --}} -->
          <div class="row mb-3">
            <label for="jabatan" class="col-sm-2 col-form-label text-start">Jabatan</label>
            <div class="col-sm-10">
              <input type="jabatan" name="jabatan" class="form-control" id="jabatan" 
                     value="{{ old('jabatan', $staffDept->jabatan) }}" placeholder="Masukkan Jabatan" required>              
            </div>
          </div>

          <!-- {{-- TANGGAL --}} -->
          <div class="row mb-3">
            <label for="tanggal_lahir" class="col-sm-2 col-form-label text-start">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" 
                     value="{{ old('tanggal_lahir', $staffDept->tanggal_lahir ? \Carbon\Carbon::parse($staffDept->tanggal_lahir)->format('Y-m-d') : '') }}" required>
            </div>
          </div>   

          {{-- EMAIL --}}
          <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label text-start">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" 
                     value="{{ old('email', $staffDept->email) }}" placeholder="Masukkan Email" required>
            </div>
          </div>

          {{-- SCOPUS --}}
          <div class="row mb-3">
            <label for="scopus" class="col-sm-2 col-form-label text-start">Scopus</label>
            <div class="col-sm-10">
              <input type="text" name="scopus" class="form-control" id="scopus" 
                     value="{{ old('scopus', $staffDept->scopus) }}" placeholder="Masukkan link Scopus">
            </div>
          </div>

          {{-- SINTA --}}
          <div class="row mb-3">
            <label for="sinta" class="col-sm-2 col-form-label text-start">Sinta</label>
            <div class="col-sm-10">
              <input type="text" name="sinta" class="form-control" id="sinta" 
                     value="{{ old('sinta', $staffDept->sinta) }}" placeholder="Masukkan link Sinta">
            </div>
          </div>

          {{-- GOOGLE SCHOLAR --}}
          <div class="row mb-3">
            <label for="google_scholar" class="col-sm-2 col-form-label text-start">Google Scholar</label>
            <div class="col-sm-10">
              <input type="text" name="google_scholar" class="form-control" id="google_scholar" 
                     value="{{ old('google_scholar', $staffDept->google_scholar) }}" placeholder="Masukkan link Google Scholar">
            </div>
          </div>

          {{-- WEBSITE --}}
          <div class="row mb-3">
            <label for="website" class="col-sm-2 col-form-label text-start">Website</label>
            <div class="col-sm-10">
              <input type="text" name="website" class="form-control" id="website" 
                     value="{{ old('website', $staffDept->website) }}" placeholder="Masukkan link website pribadi">
            </div>
          </div>

          {{-- RESEARCH GATE --}}
          <div class="row mb-3">
            <label for="researchgate" class="col-sm-2 col-form-label text-start">ResearchGate</label>
            <div class="col-sm-10">
              <input type="text" name="researchgate" class="form-control" id="researchgate" 
                     value="{{ old('researchgate', $staffDept->researchgate) }}" placeholder="Masukkan link ResearchGate">
            </div>
          </div>

          {{-- KEAHLIAN --}}
          <div class="row mb-3">
            <label for="keahlian" class="col-sm-2 col-form-label text-start">Keahlian</label>
            <div class="col-sm-10">
              <textarea name="keahlian" class="form-control" id="keahlian" rows="3" placeholder="Masukkan bidang keahlian">{{ old('keahlian', $staffDept->keahlian) }}</textarea>
            </div>
          </div>

          {{-- LINK PUBLIKASI --}}
          <div class="row mb-3">
            <label for="publikasi" class="col-sm-2 col-form-label text-start">Link Publikasi</label>
            <div class="col-sm-10">
              <textarea name="publikasi" class="form-control" id="publikasi" rows="3" placeholder="Masukkan link publikasi">{{ old('publikasi', $staffDept->publikasi ?? '') }}</textarea>
            </div>
          </div>

          {{-- RIWAYAT PENDIDIKAN --}}
          <div class="row mb-3">
            <label for="riwayat_pendidikan" class="col-sm-2 col-form-label text-start">Riwayat Pendidikan</label>
            <div class="col-sm-10">
              <textarea name="riwayat_pendidikan" class="form-control" id="riwayat_pendidikan" rows="3" placeholder="Masukkan riwayat pendidikan">{{ old('riwayat_pendidikan', $staffDept->riwayat_pendidikan) }}</textarea>
            </div>
          </div>

          {{-- BUTTON SUBMIT --}}
          <div>
          <div class="row">
              <div class="mb-3 d-flex justify-content-between align-items-center">
                  <a href="{{route('staffdept.index')}}" class="btn btn-secondary text-decoration-none">Kembali</a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>
</div>

@push('script')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const fotoInput = document.getElementById('foto');
    const previewImg = document.getElementById('preview-foto');

    fotoInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewImg.classList.remove('d-none');
      } else {
        // Kembali ke foto lama jika ada, atau kosongkan
        previewImg.src = "{{ $staffDept->foto ? asset($staffDept->foto) : '' }}";
        if ("{{ $staffDept->foto }}") {
          previewImg.classList.remove('d-none');
        } else {
          previewImg.classList.add('d-none');
        }
      }
    });
  });
</script>
@endpush
@endsection
