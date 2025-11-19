@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>
      <!-- Untuk aktifin button sub menu ========================= -->
      @php
        $isBerandaActive = Request::is('dashboardmhs');
        $isFormulirLayananActive = Request::is('formulirlayananakademikmhs');
        $isTingkatAkhirActive = 
        Request::is('kolokiummhs') || Request::is('kolokiummhs/*') || Request::is('kolokiummhs/*/edit') || Request::is('syaratkolokiummhs/*') || 
        Request::is('seminarmhs') || Request::is('seminarmhs/*') || Request::is('seminarmhs/*/edit') || Request::is('syaratseminarmhs/*') || 
        Request::is('komprehensifmhs') || Request::is('komprehensifmhs/*') || Request::is('komprehensifmhs/*/edit') || Request::is('syaratkomprehensifmhs/*');
        $isProfileMahasiswaActive = Request::is('profilemhs') || Request::is('user/*/edit') || Request::is('profilemhs/edit') || Request::is('editpassmhs');
        $isLogoutmhsActive = Request::is('logoutmhs');
        @endphp

      <!-- BTN BERANDA ===================== -->
      <a href="/dashboardmhs" class="menu {{ $isBerandaActive ? 'active' : '' }}">
        <div class="menu-left">
          <i class="bi bi-house-door-fill"></i>
          <span> Beranda </span>
        </div>
      </a>   

      <!-- BTN TINGKAT AKHIR ===================== -->
      <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="staffdept">
        <div class="menu-left">
          <i class="bi bi-mortarboard"></i>
          <span> Mahasiswa Tingkat Akhir </span>
        </div>
        <span class="dropdownArrow" data-arrow="staffdept">
          {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="staffdept"
        style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/kolokiummhs"
          class="submenu-link {{ Request::is('kolokiummhs', 'kolokiummhs*', 'kolokiummhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Kolokium
        </a>
        <a href="/syaratkolokiummhs/create"
          class="submenu-link {{ Request::is('syaratkolokiummhs', 'syaratkolokiummhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Kolokium
        </a>
        <a href="/seminarmhs"
          class="submenu-link {{ Request::is('seminarmhs', 'seminarmhs*', 'seminarmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Seminar
        </a>
        <a href="/syaratseminarmhs/create"
          class="submenu-link {{ Request::is('syaratseminarmhs', 'syaratseminarmhs/*', 'syaratseminarmhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Seminar
        </a>
        <a href="/komprehensifmhs"
          class="submenu-link {{ Request::is('komprehensifmhs', 'komprehensifmhs*', 'komprehensifmhs/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-journal-text"></i> Komprehensif
        </a>
        <a href="/syaratkomprehensifmhs/create"
          class="submenu-link {{ Request::is('syaratkomprehensifmhs', 'syaratkomprehensifmhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Komprehensif
        </a>
      </div>
    
      <!-- PEMBATAS EMAS ===================== -->
      <a href="" class="menu-image-only">
        <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>


      <!-- BTN Profile MHS ===================== -->
      <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profilemhs">
        <div class="menu-left">
          <i class="bi bi-person"></i>
          <span> Profil Mahasiswa </span>
        </div>
        <span class="dropdownArrow" data-arrow="profilemhs">
          {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
        </span>
      </a>
      <div data-menu="profilemhs"
        style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/profilemhs"
          class="submenu-link {{ Request::is('profilemhs', 'profilemhs/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
          <i class="bi bi-person-workspace"></i> Biodata Mahasiswa
        </a>
        <a href="/editpassmhs"
          class="submenu-link {{ Request::is('editpassmhs') ? 'active-submenu' : '' }}">
          <i class="bi bi-gear-wide-connected"></i> Edit Password
        </a>
      </div>

      <!-- BTN LOGOUT ===================== -->
      <form action="{{ route('login.logout') }}" method="POST" class="menu p-0 m-0">
        @csrf
        <button type="submit" class="menu w-100 text-start border-0 bg-transparent">
          <div class="menu-left">
            <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
          </div>
        </button>
      </form>      
    </aside>     

    <main class="content">     

      <h2 class="page-title">Edit Biodata Mahasiswa</h2>      
      {{-- Alert Validasi Error --}}
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">          
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif
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
      
      <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center w-100 mt-4">
        @csrf
        @method('PUT')
              
        <div class="id-card-container p-4 shadow-lg rounded-4 d-flex flex-row align-items-center w-100 mt-0" style="background: linear-gradient(135deg, #e0e7ff 60%, #f5f5f5 100%); border: 2px solid #1b2a6d; min-width: 420px;">    
          <div class="id-photo text-center me-4">
            <div class="rounded-3 overflow-hidden border border-3 border-primary mx-auto" style="width: 200px; height: 300px; background:#fff; margin-bottom: 10px;">        
              @if($user->foto)
                <img id="preview-image" src="{{ asset('profile/' . $user->foto) }}" alt="" class="w-100 h-100 object-fit-cover">
              @else
                <img id="preview-image" src="{{ asset('img/default.jpeg') }}" alt="" class="w-100 h-100 object-fit-cover">
              @endif
            </div>
            <input type="file" name="foto" accept="image/*" class="form-control form-control-sm mt-2" onchange="previewImage(event)">
          </div>
          <div class="id-data flex-grow-1">
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">Nama</label>
              <input type="text" class="form-control form-control-sm" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Nama Lengkap..." required>
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">NIM</label>
              <input type="text" class="form-control form-control-sm" name="nim" value="{{ old('nim', $user->nim) }}" placeholder="NIM..." required>
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">No Handphone</label>
              <input type="text" class="form-control form-control-sm" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Nomor Handphone..." required>
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">Email</label>
              <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email', $user->email) }}" placeholder="Email..." required>
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">Jenis Kelamin</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                <label class="form-check-label" for="jkL">Laki-laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                <label class="form-check-label" for="jkP">Perempuan</label>
              </div>
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">Tanda Tangan</label>
              <div class="row">
                <div class="col-6">              
                  <div id="preview-sign-box" 
                      style="min-height:80px;max-height:100px;display:flex;align-items:center;justify-content:center;background:#fff;border:1.5px solid #1b2a6d;border-radius:6px;">
                    @if($user->tanda_tangan)
                      <img src="{{ asset('signature/' . $user->tanda_tangan) }}" alt="Tanda Tangan" style="max-width:100%;max-height:80px;">
                    @else
                      <span style="color:#aaa;">Belum ada tanda tangan</span>
                    @endif
                  </div>
                  <img id="preview-upload-ttd" src="#" alt="Preview Upload" style="display:none; max-width:100%; max-height:80px; margin-top:4px; border:1.5px dashed #1b2a6d; border-radius:6px;" />
                  <img id="preview-canvas-ttd" src="#" alt="Preview Canvas" style="display:none; max-width:100%; max-height:80px; margin-top:4px; border:1.5px dashed #1b2a6d; border-radius:6px;" />
                </div>
                <div class="col-6">                            
                  <div class="signature-box border rounded-2 bg-white" style="width: 100%; height: 80px;">
                    <canvas id="signaturePad" style="width:100%; height:100%;"></canvas>
                  </div>
                  <div class="mt-2 d-flex gap-2">                
                    <button type="button" class="btn btn-sm btn-danger" id="clearSignature">
                      Hapus
                    </button>
                    
                    <label for="tanda_tangan_img" class="btn btn-sm btn-primary mb-0">
                      Unggah Gambar
                    </label>
                    <input type="file" name="tanda_tangan_img" id="tanda_tangan_img" accept="image/*" hidden>
                    <input type="hidden" name="tanda_tangan" id="tanda_tangan">
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-3 d-flex justify-content-end gap-2">
              <button type="submit" class="btn btn-success px-4">Simpan</button>
              <a href="{{ route('profilemhs.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
          </div>
        </div>
      </form>            
    </main>
  </div>

@push('styles')
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
@endpush

@push('script')  
  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        const output = document.getElementById('preview-image');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
    // Preview upload gambar tanda tangan
    document.getElementById('tanda_tangan_img').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const previewSignBox = document.getElementById('preview-sign-box');
      const ttdInput = document.getElementById('tanda_tangan');
      previewSignBox.innerHTML = '';
      if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
          const img = document.createElement('img');
          img.src = ev.target.result;
          img.style.maxWidth = '100%';
          img.style.maxHeight = '80px';
          previewSignBox.appendChild(img);         
        };
        reader.readAsDataURL(file);
      } else {
        previewSignBox.innerHTML = '<span style="color:#aaa;">Belum ada tanda tangan</span>';
        ttdInput.value = '';
      }
    });

    // Signature pad logic
    const canvas = document.getElementById('signaturePad');
    const ctx = canvas.getContext('2d');
    let drawing = false;
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    function startDraw(e) {
      drawing = true;
      ctx.beginPath();
      ctx.moveTo(getX(e), getY(e));
    }

    function draw(e) {
      if (!drawing) return;
      ctx.lineWidth = 2;
      ctx.lineCap = 'round';
      ctx.strokeStyle = 'black';
      ctx.lineTo(getX(e), getY(e));
      ctx.stroke();
    }

    function endDraw() {
      if (!drawing) return;
      drawing = false;
      ctx.closePath();
      // update preview SEKALI SAJA ketika selesai menggambar
      updateCanvasPreview();
    }

    function getX(e) {
      return e.clientX - canvas.getBoundingClientRect().left;
    }
    function getY(e) {
      return e.clientY - canvas.getBoundingClientRect().top;
    }

    function updateCanvasPreview() {
      const previewSignBox = document.getElementById('preview-sign-box');
      previewSignBox.innerHTML = '';
      const img = document.createElement('img');
      img.src = canvas.toDataURL();
      img.style.maxWidth = '100%';
      img.style.maxHeight = '80px';
      previewSignBox.appendChild(img);

      // Simpan ke hidden input
      document.getElementById('tanda_tangan').value = canvas.toDataURL();
    }

    // Mouse event
    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', endDraw);
    canvas.addEventListener('mouseout', endDraw);

    // Touch event
    canvas.addEventListener('touchstart', (e) => {
      e.preventDefault();
      startDraw(e.touches[0]);
    });
    canvas.addEventListener('touchmove', (e) => {
      e.preventDefault();
      draw(e.touches[0]);
    });
    canvas.addEventListener('touchend', endDraw);

    // Clear canvas
    document.getElementById('clearSignature').addEventListener('click', () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      document.getElementById('tanda_tangan').value = ''; // kosongin hidden input
      const previewSignBox = document.getElementById('preview-sign-box');
      previewSignBox.innerHTML = '<span style="color:#aaa;">Belum ada tanda tangan</span>';
    });   
  </script>
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
@endpush  
@endsection