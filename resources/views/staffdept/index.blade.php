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
    
<!-- Daftar Staff Departemen - Admin Dashboard -->
<main class="content">
<div class="container-fluid mt-4">
    <div class="adm-header">
        <h2 class="adm-title">Daftar Staff Departemen</h2>
        <button class="adm-btn-add">
            <i class="bi bi-plus"></i> Tambah Data
        </button>
    </div> 
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light ">
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Divisi</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Galeri (dummy) -->
                        <tr>
                            <td>1</td>
                            <td>
                                <img src="https://image-cdn.flowgpt.com/trans-images/1747063875154-2f5a3123-e2a4-43aa-98dc-3c46b1fe0f46.default.webp" 
                                    alt="foto" 
                                    class="img-thumbnail"
                                    style="max-width: 80px; max-height: 80px; object-fit: cover;">
                            </td>
                            <td class="text-start">Divisi</td>
                            <td class="text-start">Biokomposit</td>
                            <td class="text-start">Prof. Dr. Ir. I Wayan Darmawan, M.Sc</td>
                            <td class="text-start">Ketua PS S2 dan PS S3 ITHH</td>
                            <td>
                            <button class="btn btn-success btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-pencil" style="font-size: 18px;"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-trash" style="font-size: 18px;"></i>
                            </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4Fm042tHJbvReJ34V8xGfs0QItSEiAu3t8g&s" 
                                    alt="foto" 
                                    class="img-thumbnail"
                                    style="max-width: 80px; max-height: 80px; object-fit: cover;">
                            </td>
                            <td class="text-start">Tendik/Dosen</td>
                            <td class="text-start">Manajemen Industri HH</td>
                            <td class="text-start">Prof. Dr. Ir. Trisna Priadi, M.Eng.Sc</td>
                            <td class="text-start">Komisi Pendidikan dan PL</td>
                            <!-- Tombol Aksi -->
                        <td class="text-center">
                            <div style="display: flex; justify-content: center; gap: 6px;">
                                <button class="btn btn-success btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                    <i class="bi bi-pencil" style="font-size: 18px;"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                    <i class="bi bi-trash" style="font-size: 18px;"></i>
                                </button>
                            </div>
                        </td>
                        <!-- Tambahkan baris lain sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



    <!-- <div class="container position-relative">
        <h1>Daftar Staff Departemen</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('staffdept.create') }}" class="btn btn-primary">+ Tambah Staff</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Divisi</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffdepts as $staff)
                    <tr>
                        <td>
                            @if($staff->foto)
                                <img src="{{ asset('img/' . $staff->foto) }}" alt="Foto" width="60">
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td>{{ $staff->nama }}</td>
                        <td>{{ $staff->nip }}</td>
                        <td>{{ $staff->jabatan }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->divisi->nama ?? '-' }}</td>
                        <td>{{ $staff->kategoristaff->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('staffdept.show', $staff->id) }}" class="btn btn-primary btn-sm">show</a>
                            <a href="{{ route('staffdept.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('staffdept.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($staffdepts->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data staff</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div> -->