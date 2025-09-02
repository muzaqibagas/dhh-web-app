@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <a href="#" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      
      <a href="/dashboardmhs" class="menu ">
        <div class="menu-left">
          <i class="bi bi-house-door-fill"></i> <span> Beranda </span>
        </div>
      </a>
      <a href="/profilemhs" class="menu active">
        <div class="menu-left">
          <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
        </div>
      </a>
      <a href="/formulirlayananakademikmhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-file-earmark-text"></i> <span> Formulir Layanan Akademik </span>
        </div>
      </a>
      <a href="" class="menu" id="dropdownToggle">
        <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
        <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">&#9650;</span>
      </a>
      <div id="dropdownMenu" style="display:none; margin-left:24px; flex-direction:column;">
        <a href="/kolokiummhs" class="submenu-link"><i class="bi bi-check2-circle"></i> Kolokium</a>
        <a href="/syaratkolokiummhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Kolokium</a>
        <a href="/seminarmhs" class="submenu-link"><i class="bi bi-calendar-event"></i> Seminar</a>
        <a href="/syaratseminarmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Seminar</a>
        <a href="/komprehensifmhs" class="submenu-link"><i class="bi bi-journal-text"></i> Komprehensif</a>
        <a href="/syaratkomprehensifmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat Komprehensif</a>
      </div>
      <a href="/dashboardmhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
        </div>
      </a>

      <script>
        document.getElementById('dropdownToggle').addEventListener('click', function(e) {
          e.preventDefault();
          var menu = document.getElementById('dropdownMenu');
          var arrow = document.getElementById('dropdownArrow');
          var isOpen = menu.style.display === 'flex';
          menu.style.display = isOpen ? 'none' : 'flex';
          arrow.innerHTML = isOpen ? '&#9650;' : '&#9660;'; // atas: &#9650;, bawah: &#9660;
       });
      </script>

    </aside>

<main class="content">
  <h2 class="page-title">Biodata Mahasiswa</h2>
  <div class="id-card-container p-4 shadow-lg rounded-4 d-flex flex-row align-items-center w-100 mt-4" style="background: linear-gradient(135deg, #e0e7ff 60%, #f5f5f5 100%); border: 2px solid #1b2a6d; min-width: 420px;">
    <div class="id-photo text-center me-4">
      <div class="rounded-3 overflow-hidden border border-3 border-primary mx-auto" style="width: 200px; height: 300px; background:#fff; margin-bottom: 10px;">
        @if($user->foto)
          <img id="preview-image" src="{{ asset('profile/' . $user->foto) }}" alt="" class="w-100 h-100 object-fit-cover">
        @else
          <img id="preview-image" src="{{ asset('img/default.jpeg') }}" alt="" class="w-100 h-100 object-fit-cover">
        @endif
      </div>
      <a href="{{ route('profilemhs.edit') }}" class="btn btn-primary w-100"><i class="bi bi-pencil-square"></i> Edit Profile</a>
    </div>
    <div class="id-data flex-grow-1">
      <div class="mb-2">
        <label class="form-label fw-bold mb-0">Nama</label>
        <input type="text" class="form-control form-control-sm" value="{{ $user->nama ?? '-' }}" readonly style="background-color:#f5f5f5;">
      </div>
      <div class="mb-2">
        <label class="form-label fw-bold mb-0">NIM</label>
        <input type="text" class="form-control form-control-sm" value="{{ $user->nim ?? '-' }}" readonly style="background-color:#f5f5f5;">
      </div>
      <div class="mb-2">
        <label class="form-label fw-bold mb-0">Email</label>
        <input type="text" class="form-control form-control-sm" value="{{ $user->email ?? '-' }}" readonly style="background-color:#f5f5f5;">
      </div>
      <div class="mb-2">
        <label class="form-label fw-bold mb-0">Jenis Kelamin</label><br>
        <input type="text" class="form-control form-control-sm" value="{{ $user->jenis_kelamin ?? '-' }}" readonly style="background-color:#f5f5f5;">
      </div>
      <div class="signature-box w-50" 
          style="min-height:80px; max-height:100px; display:flex; align-items:center; justify-content:center; background:#fff; border:1.5px solid #1b2a6d; border-radius:6px;">                                         
        @if($user->tanda_tangan)
          <img src="{{ asset('signature/' . $user->tanda_tangan) }}" 
              alt="Tanda Tangan" 
              style="max-width: 100%; max-height: 100%; object-fit: contain; height: auto; width: auto;">
        @else
          <span style="color:#aaa;">Belum ada tanda tangan</span>
        @endif
      </div>
    </div>
  </div>
  <style>
    .id-card-container {
      box-shadow: 0 4px 24px 0 rgba(30, 41, 59, 0.10);
      border-radius: 18px;
      margin-top: 32px;
      margin-bottom: 32px;
    }
    .id-data label {
      color: #1b2a6d;
    }
    .id-data input, .id-data .form-check-input {
      font-size: 1em;
    }
    .signature-box {
      min-height: 60px;
      max-height: 90px;
      border: 1.5px dashed #1b2a6d;
    }
  </style>
</main>

@endsection

</body>
