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
            <h2 class="page-title">Persyaratan Sidang Akhir</h2>
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif      
              <ol class="syarat-list">
                <li><b>Batas Waktu</b><br>
                  Pengurusan administrasi seminar tugas akhir paling lambat dilakukan 6 hari kerja sebelum pelaksanaan seminar (H-6). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar tidak melewati batas waktu yang telah ditentukan.
                </li>
                <li><b>Formulir Pendaftaran Ujian Akhir Sarjana</b><br>
                  Mahasiswa diminta mengisi formulir pendaftaran di halaman Komprehesif dan meminta tanda tangan dosen pembimbing (dapat menggunakan Digsign IPB) dan mengunggah file tersebut di halaman ini. Formulir ini akan disahkan oleh Ketua Departemen oleh pihak TU.
                </li>
                <li><b>Telah Menyelesaikan Seluruh Mata Kuliah.</b><br>
                  Mahasiswa diminta mengunggah file dokumen bukti telah menyelesaikan seluruh mata kuliah yang telah ditetapkan di halaman ini. termasuk seminar, dengan jumlah minimal 138 SKS dan IPK keseluruhan minimal 2,00 tanpa nilai E.
                </li>
                <li><b>Bukti Pelunasan SPP</b><br>
                  Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan jelas dan sudah dalam format .pdf
                </li>
                </li>
                <li><b>Buku Konsultasi</b><br>
                  Mahasiswa diminta menyerahkan buku konsultasi yang telah diisi lengkap dan ditandatangani oleh dosen pembimbing (wajib diserahkan secara fisik ke bagian TU).
                </li>
                <li><b>Draft Skripsi yang Siap Ujian</b><br>
                  Mahasiswa diminta membawa draft skripsi yang telah ditandatangani oleh Komisi Pembimbing dan Ketua Departemen. (Sebanyak 3-4 eksemplar wajib diserahkan secara fisik ke bagian TU).
                </li>
                <li><b>Proceeding dan Ringkasan (CD & Hardcopy)</b><br>
                  Mahasiswa diminta membawa proceeding (berbahasa Inggris) dan ringkasan skripsi dalam bentuk CD serta 1 lembar hardcopy masing-masing (wajib diserahkan secara fisik ke bagian TU).
                </li>
              </ol>

            <!-- {{-- Kondisi jika sudah disetujui --}} -->
            @if($syarat && $syarat->status === 'disetujui')
                <div class="alert alert-success">
                    Dokumen Anda sudah <b>disetujui</b>. Anda tidak bisa upload lagi.
                </div>

            <!-- {{-- Kondisi jika ditolak --}} -->
            @elseif($syarat && $syarat->status === 'ditolak')
              <div class="alert alert-warning">
                Dokumen Anda <b>ditolak</b>. Silakan perbaiki dan upload ulang dokumen berikut:
                <ul>
                  @if($syarat->alasan_formulir)<li><b>Formulir Komprehensif Hasil:</b> {{ $syarat->alasan_formulir }}</li>@endif
                  @if($syarat->alasan_bukti_sks)<li><b>Bukti SKS:</b> {{ $syarat->alasan_bukti_sks }}</li>@endif
                  @if($syarat->alasan_bukti_spp)<li><b>Bukti SPP:</b> {{ $syarat->alasan_bukti_spp }}</li>@endif
                  @if($syarat->alasan_bukti_kehadiran)<li><b>Bukti Kehadiran:</b> {{ $syarat->alasan_bukti_kehadiran }}</li>@endif
                </ul>
              </div>
              
              <div class="upload-section">
                <h4><i class="bi bi-upload"></i> Upload Ulang Dokumen Ditolak</h4>
                <form action="{{ route('syaratkomprehensifmhs.reupload', $syarat->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if($syarat->alasan_formulir)
                    <div class="form-group">
                      <label>Upload Ulang Formulir Komprehensif Hasil <small class="text-danger">(*format wajib .PDF)</small></label>
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
                      <label>Upload Ulang Bukti Kehadiran Seminar Hasil <small class="text-danger">(*format wajib .PDF)</small></label>
                      <input type="file" name="bukti_kehadiran" accept=".pdf" required>
                    </div>
                  @endif
                  <div class="form-actions d-flex justify-content-end">
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
                    <strong>BAP Anda telah diterima.</strong> Semua persyaratan seminar hasil sudah lengkap dan disetujui.
                </div>

            <!-- {{-- kondisi kalau BAP ditolak --}} -->
            @elseif ($syarat && $syarat->bap === 'ditolak' && !$syarat->formulir)
              <div class="alert alert-warning">
                <strong>BAP Anda ditolak.</strong> Silakan unggah ulang<strong>Formulir Seminar Hasil</strong> dengan jadwal baru untuk penjadwalan ulang.
                <ul>
                  @if($syarat->alasan_formulir)<li><b>Formulir Seminar Hasil:</b> {{ $syarat->alasan_formulir }}</li>@endif                
                </ul>
              </div>       
            
            <!-- {{-- Kondisi default (belum pernah upload) --}} -->            
            @else
                <div class="upload-section">
                    <h4><i class="bi bi-upload"></i> Form Upload Dokumen</h4>
                    <form action="{{ route('syaratkomprehensifmhs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload Formulir Pendaftaran Komprehensif</label>
                            <input type="file" name="formulir" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti Menyelesaikan 110 SKS</label>
                            <input type="file" name="bukti_sks" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti TF / SPP Lunas</label>
                            <input type="file" name="bukti_spp" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>                      

                        <div class="form-group">
                        <label>Upload Bukti Kehadiran Komprehensif</label>
                        <input type="file" name="bukti_kehadiran" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection