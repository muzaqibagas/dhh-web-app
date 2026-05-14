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

    <!-- BTN PENILAIAN ===================== -->
    <a href="{{ route('penilaianadm.index') }}" class="menu {{ Request::is('penilaianadm*') ? 'active' : '' }}">
    <div class="menu-left">
        <i class="bi bi-file-earmark-bar-graph-fill"></i> <span> Penilaian </span>
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

    {{-- KOLOKIUM --}}
    <a href="{{ route('syaratujian.index', ['jenis' => 'kolokium']) }}"
        class="submenu-link {{ request('jenis') == 'kolokium' ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
    </a>

    {{-- SEMINAR --}}
    <a href="{{ route('syaratujian.index', ['jenis' => 'seminar']) }}"
        class="submenu-link {{ request('jenis') == 'seminar' ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
    </a>

    {{-- KOMPRE --}}
    <a href="{{ route('syaratujian.index', ['jenis' => 'komprehensif']) }}"
        class="submenu-link {{ request('jenis') == 'komprehensif' ? 'active-submenu' : '' }}">
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
    <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
        @csrf
        <button type="submit" class="submenu-link w-100 text-start{{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
            <i class="bi bi-box-arrow-right"></i> Log Out
        </button>
    </form>        
  </aside>

  <!-- KONTEN DEPARTEMEN -->
  <main class="content">
    <div class="container-fluid mt-4">
      <div class="adm-header">
          <h2 class="adm-title">Create Konten Jenjang</h2>
      </div> 
      <div class="card shadow-sm">
          <div class="card-body">
              <form action="{{ route('kontenjenjang.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <!-- Jenjang -->
                  <div class="row mb-3 align-items-center">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Jenjang</label>
                      <div class="col-sm-10">
                          <select name="id_jenjang" class="form-control" required>
                              <option value="">-- Pilih Jenjang --</option>
                              @foreach($jenjangs as $jenjang)
                                  <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <!-- Profil -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Profile</label>
                      <div class="col-sm-10">
                          <textarea name="profil" rows="3" class="form-control" placeholder="Profile Program Studi..." required>{{ old('profil') }}</textarea>
                      </div>
                  </div>

                  <!-- Foto -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Foto</label>
                      <div class="col-sm-10">
                          <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImage(event, 'preview-foto')" required>
                          <div class="preview-wrapper">
                              <img id="preview-foto" class="d-none preview-img">
                          </div>
                      </div>
                  </div>

                  <!-- Visi -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Visi</label>
                      <div class="col-sm-10">
                          <textarea name="visi" rows="3" class="form-control" placeholder="Visi...">{{ old('visi') }}</textarea>
                      </div>
                  </div>

                  <!-- Misi -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Misi</label>
                      <div class="col-sm-10">
                          <textarea name="misi" rows="3" class="form-control" placeholder="Misi...">{{ old('misi') }}</textarea>
                      </div>
                  </div>

                  <!-- Tujuan Pendidikan -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Tujuan Pendidikan</label>
                      <div class="col-sm-10">
                          <textarea name="tujuanpendidikan" rows="3" class="form-control" placeholder="Tujuan Pendidikan...">{{ old('tujuanpendidikan') }}</textarea>
                      </div>
                  </div>

                  <!-- Kompetensi Lulusan -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Kompetensi Lulusan</label>
                      <div class="col-sm-10">
                          <textarea name="kompetensilulusan" rows="3" class="form-control" placeholder="Kompetensi Lulusan..." required>{{ old('kompetensilulusan') }}</textarea>
                      </div>
                  </div>

                  <!-- Capaian Pembelajaran -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Capaian Pembelajaran</label>
                      <div class="col-sm-10">
                          <textarea name="capaianpembelajaran" rows="3" class="form-control" placeholder="Capaian Pembelajaran..." required>{{ old('capaianpembelajaran') }}</textarea>
                      </div>
                  </div>

                  <!-- Leaflet -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Leaflet</label>
                      <div class="col-sm-10">
                          <input type="file" name="leaflet[]" class="form-control" accept="image/*" multiple>                          
                          <div id="leaflet-preview" class="d-flex justify-content-center flex-wrap gap-2 mt-2"></div>                
                      </div>
                  </div>

                  <!-- Sertifikat Akreditasi -->
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label fw-bold text-start">Sertifikat Akreditasi</label>
                      <div class="col-sm-10">
                          <input type="file" name="sertifikatakreditasi" class="form-control" accept="image/*" onchange="previewImage(event, 'preview-akreditasi')" required>
                          <div class="preview-wrapper">
                              <img id="preview-akreditasi" class="d-none preview-img">
                          </div>
                      </div>
                  </div>
                  <!-- Deskripsi Akreditasi -->
                  <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">                    
                    <label class="col-sm-2 preview-akreditasicol-form-label fw-bold text-start">Deskripsi Akreditasi</label>                    
                    <div class="col-sm-10">                
                      <input type="text" class="form-control" id="deskripsiakreditasi" name="deskripsiakreditasi" value="{{ old('deskripsiakreditasi') }}" placeholder="Deskripsi Akreditasi..." required>
                    </div>
                  </div>

                  <!-- Tombol -->
                  <div class="text-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>

              </form>
          </div>
      </div>
    </div>
  </main>
</div>

<style>
.preview-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.preview-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ddd;
}
</style>
@push('script')
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
<script>
function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
document.querySelector('input[name="leaflet[]"]').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('leaflet-preview');
    previewContainer.innerHTML = ""; // Reset preview
    
    const files = e.target.files;

    // Maksimal 2 file
    if (files.length > 2) {
        alert("Maksimal upload 2 leaflet!");
        e.target.value = ""; 
        return;
    }

    // Loop untuk buat preview
    Array.from(files).forEach(file => {
        // Hanya file gambar
        if (!file.type.startsWith("image/")) return;

        const reader = new FileReader();
        
        reader.onload = function(event) {
            const img = document.createElement("img");
            img.src = event.target.result;
            img.className = "preview-img";
            img.style.width = "150px";
            img.style.height = "150px";
            img.style.objectFit = "cover";
            
            previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
});
</script>
@endpush
@endsection