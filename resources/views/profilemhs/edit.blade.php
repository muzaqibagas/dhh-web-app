@extends('layouts.apps')

@section('content')
<!-- SIDEBAR -->
  <div class="main-container">
    <aside class="sidebar">
      <a href="#" class="menu-image-only">
        <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
      </a>

      @if(!empty($user->nama) && !empty($user->nim) && !empty($user->email) && !empty($user->jenis_kelamin) && !empty($user->foto) && !empty($user->tanda_tangan))
        <a href="/dashboardmhs" class="menu">
          <div class="menu-left">
            <i class="bi bi-house-door-fill"></i> <span> Beranda </span>
          </div>
        </a>
      @endif

      <a href="/profilemhs" class="menu active">
        <div class="menu-left">
          <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
        </div>
      </a>
      
      @if(!empty($user->nama) && !empty($user->nim) && !empty($user->email) && !empty($user->jenis_kelamin) && !empty($user->foto) && !empty($user->tanda_tangan))        
        
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
      @endif        

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
      <h2 class="page-title">Edit Biodata Mahasiswa</h2>
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
              <input type="text" class="form-control form-control-sm" name="nama" value="{{ old('nama', $user->nama) }}">
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">NIM</label>
              <input type="text" class="form-control form-control-sm" name="nim" value="{{ old('nim', $user->nim) }}">
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold mb-0">Email</label>
              <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email', $user->email) }}">
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
      // update preview
      updateCanvasPreview();
    }
    function endDraw() {
      drawing = false;
      ctx.closePath();
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
    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', endDraw);
    canvas.addEventListener('mouseout', endDraw);
    canvas.addEventListener('touchstart', (e) => {
      e.preventDefault();
      startDraw(e.touches[0]);
    });
    canvas.addEventListener('touchmove', (e) => {
      e.preventDefault();
      draw(e.touches[0]);
    });
    canvas.addEventListener('touchend', endDraw);
    document.getElementById('clearSignature').addEventListener('click', () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      updateCanvasPreview();
    });
  </script>
@endpush  
@endsection