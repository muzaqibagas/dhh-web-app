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

  <!-- CONTENT -->
  <main class="content">
    <div class="container-fluid mt-4">
        <div class="adm-header">
          <h2 class="adm-title">Daftar Artikel</h2>
          <div class="d-flex justify-content-end align-items-center gap-2">
            <form action="{{ route('artikel.index') }}" method="GET" class="d-flex align-items-center gap-2 w-50">
              <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
              <button type="submit" class="btn btn-primary px-3">
                <i class="bi bi-search"></i>
              </button>
            </form>
            <a href="{{route('artikel.create')}}" class="adm-btn-add text-decoration-none">
              <i class="bi bi-plus"></i>Tambah Data
            </a>
          </div>          
        </div>
        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif
        {{-- Alert Error --}}
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif     
        {{-- Alert Info --}}
        @if(session('info'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            {{ session('info') }}
          </div>
        @endif            

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light ">
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Tanggal</th>                                
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse($artikels as $index => $artikel)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>
                                @if($artikel->foto)
                                  <img src="{{ asset($artikel->foto) }}" 
                                    alt="foto" 
                                    class="img-thumbnail"
                                    style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                @else
                                  <span class="text-muted">-</span>
                                @endif
                              </td>
                              <td class="text-start text-truncate" style="max-width: 200px;">
                                {{ $artikel->judul }}
                              </td>
                              <td>{{ \Carbon\Carbon::parse($artikel->tanggal)->format('d/m/Y') }}</td>                              
                              <td>{{ $artikel->kategoriartikel->nama ?? '-' }}</td>
                              <td class="text-center">
                                <div style="display: flex; justify-content: center; gap: 6px;">
                                  <a href="{{ route('artikel.edit', $artikel->id) }}" 
                                    class="btn btn-success btn-sm" style="width: 30px; height: 30px; padding: 0;">
                                    <i class="bi bi-pencil" style="font-size: 18px;"></i>
                                  </a>
                                  <button type="submit" class="btn btn-danger btn-sm" style="width: 30px; height: 30px; padding: 0;" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $artikel->id }}">
                                    <i class="bi bi-trash" style="font-size: 18px;"></i>
                                  </button>
                                  <div class="modal fade" id="hapusModal{{ $artikel->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="hapusModalLabel"></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column align-items-center justify-content-center">                                          
                                          <i class="bi bi-emoji-frown-fill text-warning" style="font-size: 4rem;"></i>
                                          <div>Apakah Anda yakin ingin menghapus Artikel ini?</div>                                          
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                          <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')                                            
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                                      
                                </div>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="6" class="text-center text-muted py-4">Belum ada artikel.</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </main>
</div>
@endsection