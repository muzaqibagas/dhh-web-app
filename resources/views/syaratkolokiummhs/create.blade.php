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
      <a href="/profilemhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
        </div>
      </a>
      <a href="/formulirlayananakademikmhs" class="menu">
        <div class="menu-left">
          <i class="bi bi-file-earmark-text"></i> <span> Formulir Layanan Akademik </span>
        </div>
      </a>
      <!-- <a href="#" class="menu"><i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir</a> -->
      <a href="#" class="menu {{ request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? 'active' : '' }}" id="dropdownToggle">
          <i class="bi bi-mortarboard"></i> Mahasiswa Tingkat Akhir
          <span id="dropdownArrow" style="font-size:0.8em; margin-left:6px;">
              {{-- kalau ada di salah satu submenu → panah kebuka ▼ --}}
              {!! request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? '&#9660;' : '&#9650;' !!}
          </span>
      </a>

      <div id="dropdownMenu" 
          style="margin-left:24px; flex-direction:column; 
              {{ request()->is('kolokiummhs','syaratkolokiummhs','seminarmhs','syaratseminarmhs','komprehensifmhs','syaratkomprehensifmhs') ? 'display:flex;' : 'display:none;' }}">
        
          <a href="/kolokiummhs" 
            class="submenu-link {{ request()->is('kolokiummhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-check2-circle"></i> Kolokium
          </a>
          <a href="/syaratkolokiummhs" 
            class="submenu-link {{ request()->is('syaratkolokiummhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-info-circle"></i> Syarat Kolokium
          </a>
          <a href="/seminarmhs" 
            class="submenu-link {{ request()->is('seminarmhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-calendar-event"></i> Seminar
          </a>
          <a href="/syaratseminarmhs" 
            class="submenu-link {{ request()->is('syaratseminarmhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-info-circle"></i> Syarat Seminar
          </a>
          <a href="/komprehensifmhs" 
            class="submenu-link {{ request()->is('komprehensifmhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-journal-text"></i> Komprehensif
          </a>
          <a href="/syaratkomprehensifmhs" 
            class="submenu-link {{ request()->is('syaratkomprehensifmhs') ? 'active-submenu' : '' }}">
              <i class="bi bi-info-circle"></i> Syarat Komprehensif
          </a>
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

    <!-- MAIN CONTENT -->
    <main class="content">
      <div class="syarat-card">
          <h2 class="page-title">Persyaratan Kolokium</h2> 
          {{-- Alert Error --}}
          @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">              
                  {!! session('error') !!}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif                            
            <ol class="syarat-list">
                <li><b>Batas Waktu Pengurusan Administrasi</b><br>
                    Pengurusan administrasi seminar tugas akhir paling lambat dilakukan 4 hari kerja sebelum pelaksanaan seminar (H-4). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar tidak melewati batas waktu yang telah ditentukan.
                </li>
                <li><b>Formulir Pendaftaran Kolokium</b><br>
                    Mahasiswa diminta mengisi dan mengunggah foto formulir pendaftaran kolokium yang telah ditandatangani oleh dosen pembimbing (dapat menggunakan Digsign IPB) dan kemudian diunggah kembali melalui halaman ini. Setelah diterima, formulir akan disahkan oleh Ketua Departemen melalui bagian Tata Usaha (TU).
                </li>
                <li><b>Bukti Transkrip Nilai</b><br>
                    Lampirkan bukti jumlah transkrip nilai dengan total minimal 110 SKS.
                </li>
                <li><b>Bukti Pelunasan SPP</b><br>
                    Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan jelas dan sudah dalam format .pdf
                </li>
                <li><b>Makalah Kolokium</b><br>
                    Kumpulkan file hardfile makalah kolokium yang telah disetujui oleh dosen pembimbing ke bagian administrasi.
                </li>
                <li><b>Map Folio (4 Buah)</b><br>
                    Siapkan dan kumpulkan 4 buah map folio secara fisik ke bagian administrasi bersamaan dengan makalah kolokium setelah semua dokumen diunggah secara daring.
                </li>
            </ol>

          <!-- {{-- Kondisi jika sudah disetujui --}} -->
          @if($syarat && $syarat->status === 'disetujui')
            <div class="alert alert-success">
              Dokumen Anda sudah <b>disetujui</b>. Anda tidak bisa upload lagi, silahkan melaksanakan Kolokium.
            </div>

          <!-- {{-- Kondisi jika ditolak --}} -->
          @elseif($syarat && $syarat->status === 'ditolak')
            <div class="alert alert-warning">
              Dokumen Anda <b>ditolak</b>. Silakan perbaiki dan upload ulang dokumen berikut:
              <ul>
                @if($syarat->alasan_formulir)<li><b>Formulir Kolokium:</b> {{ $syarat->alasan_formulir }}</li>@endif
                @if($syarat->alasan_bukti_sks)<li><b>Bukti SKS:</b> {{ $syarat->alasan_bukti_sks }}</li>@endif
                @if($syarat->alasan_bukti_spp)<li><b>Bukti SPP:</b> {{ $syarat->alasan_bukti_spp }}</li>@endif
                @if($syarat->alasan_bukti_kehadiran)<li><b>Bukti Kehadiran:</b> {{ $syarat->alasan_bukti_kehadiran }}</li>@endif
              </ul>
            </div>

            <!-- {{-- Form reupload --}} -->
            <div class="upload-section">
              <h4><i class="bi bi-upload"></i> Upload Ulang Dokumen Ditolak</h4>
              <form action="{{ route('syaratkolokiummhs.reupload', $syarat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($syarat->alasan_formulir)
                  <div class="form-group">
                    <label>Upload Ulang Formulir Kolokium <small class="text-danger">(*format wajib .PDF)</small></label>
                    <input type="file" name="formulir" accept=".pdf" required>
                  </div>
                @endif
                @if($syarat->alasan_bukti_sks)
                  <div class="form-group">
                    <label>Upload Ulang Bukti SKS <small class="text-danger">(*format wajib .PDF)</small></label>
                    <input type="file" name="bukti_sks" accept=".pdf" required>
                  </div>
                @endif
                @if($syarat->alasan_bukti_spp)
                  <div class="form-group">
                    <label>Upload Ulang Bukti SPP <small class="text-danger">(*format wajib .PDF)</small></label>
                    <input type="file" name="bukti_spp" accept=".pdf" required>
                  </div>
                @endif
                @if($syarat->alasan_bukti_kehadiran)
                  <div class="form-group">
                    <label>Upload Ulang Bukti Kehadiran Kolokium <small class="text-danger">(*format wajib .PDF)</small></label>
                    <input type="file" name="bukti_kehadiran" accept=".pdf" required>
                  </div>
                @endif
                <div class="form-actions">
                  <button type="submit" class="btn btn-warning">Upload Ulang</button>
                </div>
              </form>
            </div>  

          <!-- {{-- Kondisi jika pending --}} -->
          @elseif($syarat && $syarat->status === 'pending')
            <div class="alert alert-info">
              Dokumen Anda sedang <b>menunggu konfirmasi admin</b>. Anda tidak dapat mengupload dokumen baru sampai dikonfirmasi.
            </div>

          <!-- {{-- kondisi kalau BAP diterima --}} -->
          @elseif ($syarat && $syarat->bap === 'diterima')
              <div class="alert alert-success">
                  <strong>BAP Anda telah diterima.</strong> Semua persyaratan kolokium sudah lengkap dan disetujui.
              </div>  

          <!-- {{-- kondisi kalau BAP ditolak --}} -->
          @elseif ($syarat && $syarat->bap === 'ditolak' && !$syarat->formulir)
            <div class="alert alert-warning">
              <strong>BAP Anda ditolak.</strong> Silakan unggah ulang<strong>Formulir Kolokium</strong> dengan jadwal baru untuk penjadwalan ulang.
              <ul>
                @if($syarat->alasan_formulir)<li><b>Formulir Kolokium:</b> {{ $syarat->alasan_formulir }}</li>@endif                
              </ul>
            </div>        

          <!-- {{-- Kondisi default (belum pernah upload) --}} -->
          @else
            <div class="upload-section">
              <h4><i class="bi bi-upload"></i> Form Upload Dokumen</h4>
              <form action="{{ route('syaratkolokiummhs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Upload Formulir Pendaftaran Kolokium <small class="text-danger">(*format wajib .PDF)</small></label>
                  <input type="file" name="formulir" accept=".pdf" required>
                </div>

                <div class="form-group">
                  <label>Upload Bukti Menyelesaikan 110 SKS <small class="text-danger">(*format wajib .PDF)</small></label>
                  <input type="file" name="bukti_sks" accept=".pdf" required>
                </div>

                <div class="form-group">
                  <label>Upload Bukti TF / SPP Lunas <small class="text-danger">(*format wajib .PDF)</small></label>
                  <input type="file" name="bukti_spp" accept=".pdf" required>
                </div>

                <div class="form-group">
                  <label>Upload Bukti Kehadiran Kolokium <small class="text-danger">(*format wajib .PDF)</small></label>
                  <input type="file" name="bukti_kehadiran" accept=".pdf" required>
                </div>
                <div class="form-actions"><button type="submit" class="btn-submit">Simpan</button></div>
              </form>
            </div>
          @endif
      </div>
    </main>
</div>
@endsection
