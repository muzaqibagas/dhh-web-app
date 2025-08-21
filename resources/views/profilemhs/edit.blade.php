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

  <div class="biodata-container">
    
    <!-- FOTO MAHASISWA -->
    <div class="photo-section">
      <div class="photo-placeholder">
    </div>

    <input type="file" name="foto" accept="image/*" class="form-control mt-3" onchange="previewImage(event)">
    </div>

    <!-- DATA MAHASISWA -->
    <div class="info-section">
      <div class="info-box">
        <div class="info-item">
          <label>Nama</label>
          <input type="text" value="Muzaqi Bagas">
        </div>
        <div class="info-item">
          <label>NIM</label>
          <form><input type="text" value="J024567XXXX"></form>
        </div>
        <div class="info-item">
          <label>Email</label>
          <input type="text" value="bagas@apps.ipb.ac.id">
        </div>
        <div class="info-item">
        <label>Tanda Tangan</label>
        <div class="signature-box border" style="width: 100%; height: 150px; background: #fff;">
            <canvas id="signaturePad" style="width:100%; height:100%;"></canvas>
        </div>
        <div class="mt-2">
            <button type="button" class="btn btn-sm btn-danger" id="clearSignature">Hapus</button>
        </div>
        </div>

        <script>
            const canvas = document.getElementById('signaturePad');
            const ctx = canvas.getContext('2d');
            let drawing = false;

            // sesuaikan ukuran canvas dengan div
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
                drawing = false;
                ctx.closePath();
            }

            function getX(e) {
                return e.clientX - canvas.getBoundingClientRect().left;
            }
            function getY(e) {
                return e.clientY - canvas.getBoundingClientRect().top;
            }

            // event mouse
            canvas.addEventListener('mousedown', startDraw);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', endDraw);
            canvas.addEventListener('mouseout', endDraw);

            // event touchscreen (biar bisa tanda tangan di HP juga)
            canvas.addEventListener('touchstart', (e) => {
                e.preventDefault();
                startDraw(e.touches[0]);
            });
            canvas.addEventListener('touchmove', (e) => {
                e.preventDefault();
                draw(e.touches[0]);
            });
            canvas.addEventListener('touchend', endDraw);

            // clear canvas
            document.getElementById('clearSignature').addEventListener('click', () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });
        </script>


        <!-- BUTTONS -->
        <div class="text-end mt-3">
          <a href="{{ route('profilemhs.index') }}" class="btn btn-secondary">Batal</a>
          <button type="submit" class="btn btn-success" style="background-color: #28a745;">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection

</body>