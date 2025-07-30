@extends('layouts.apps')

@section('content')
<div class="main-container">
  <aside class="sidebar">
    <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- BTN AKADEMIK========================= -->
      <a href="" class="menu" id="dropdownToggle">
        <div class="menu-left">
          <i class="bi bi-journal-check"></i> 
          <span> Akademik </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admdaftarkurikulum" class="submenu-link"><i class="bi bi-archive"></i> Daftar Kurikulum</a>
        <a href="/admmatakuliah" class="submenu-link"><i class="bi bi-journals"></i> Mata Kuliah</a>
      </div>

      <!-- BTN TINGKAT AKHIR===================== -->
      <a href="" class="menu" id="dropdownToggle2">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span>Tingkat Akhir</span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow2">&#9650;</span>
      </a>
      <div id="dropdownMenu2" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admsurat undangan" class="submenu-link"><i class="bi bi-envelope-open"></i> Surat Undangan</a>
        <a href="/admdatapendaftarkolokium" class="submenu-link"><i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium</a>
        <a href="/admdatapendaftarseminar" class="submenu-link"><i class="bi bi-calendar-event"></i> Data Pendaftar Seminar</a>
        <a href="/admdatapendaftarsidang" class="submenu-link"><i class="bi bi-journal-text"></i> Data Pendaftar Sidang</a>
        <a href="/admpengumuman" class="submenu-link"><i class="bi bi-megaphone"></i> Pengumuman</a>
      </div>

      <!-- BTN KONTEN ===================== -->
      <a href="" class="menu" id="dropdownToggle3">
        <div class="menu-left">
          <i class="bi bi-collection"></i> 
          <span> Konten </span>
        </div>
        <span class="dropdownArrow" id="dropdownArrow3">&#9650;</span>
      </a>
      <div id="dropdownMenu3" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/admkategori" class="submenu-link"><i class="bi bi-info-circle"></i> Kategori</a>
        <a href="/admgaleri" class="submenu-link"><i class="bi bi-images"></i> Galeri</a>
        <a href="/admartikel" class="submenu-link"><i class="bi bi-layout-text-window"></i> Artikel </a>
        <a href="/admreviewalumni" class="submenu-link"><i class="bi bi-star"></i> Review Alumni </a>
        <a href="/admkontendepart" class="submenu-link"><i class="bi bi-laptop"></i> Konten Departemen </a>
      </div>
      <a href="/admsumberdayamanusia" class="menu">
        <div class="menu-left">
          <i class="bi bi-people-fill"></i> <span> Sumber Daya Manusia </span>
        </div>
        <span class="dropdownArrow"></span>
      </a>
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
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
    <h2 class="page-title">Edit Biodata Admin</h2>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="col-md-9 px-2 d-flex justify-content-center align-items-start gap-5 w-100 mt-4">
      @csrf
      @method('PUT')

      <!-- FOTO PROFIL -->
      <div class="d-flex flex-column align-items-center">
        <div class="rounded-circle overflow-hidden" style="width: 180px; height: 180px; background-color:#f5f5f5">
          @if($user->foto)
            <img id="preview-image" src="{{ asset('profile/' . $user->foto) }}" alt="" class="w-100 h-100 object-fit-cover">
          @else
            <img id="preview-image" src="{{ asset('img/default.png') }}" alt="" class="w-100 h-100 object-fit-cover">
          @endif
        </div>

        <input type="file" name="foto" accept="image/*" class="form-control mt-3" onchange="previewImage(event)">
      </div>

      <!-- FORM BIODATA -->
      <div class="card p-4 shadow-sm w-100 border-2" style="border:solid #1b2a6d">
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Username</label>
          <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Nama</label>
          <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}">
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
        </div>
        <div class="text-start mb-2">
          <label class="form-label fw-bold mb-0">Jenis Kelamin</label>
          <select class="form-select" name="jenis_kelamin">
            <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
        </div>

        <!-- BUTTONS -->
        <div class="text-start mt-3">
          <button type="submit" class="btn btn-success" style="background-color: #28a745;">Simpan</button>
          <a href="{{ route('admprofile.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
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