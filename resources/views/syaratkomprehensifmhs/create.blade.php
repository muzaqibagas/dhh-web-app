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
        $isTingkatAkhirActive = Request::is('kolokiummhs/*') || Request::is('syaratkolokiummhs/*') || Request::is('seminarmhs/*') || Request::is('syaratseminarmhs/*') || Request::is('komprehensifmhs/*') || Request::is('syaratkomprehensifmhs/*');
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
          class="submenu-link {{ Request::is('kolokiummhs') ? 'active-submenu' : '' }}">
          <i class="bi bi-check2-circle"></i> Kolokium
        </a>
        <a href="/syaratkolokiummhs/create"
          class="submenu-link {{ Request::is('syaratkolokiummhs', 'syaratkolokiummhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Kolokium
        </a>
        <a href="/seminarmhs"
          class="submenu-link {{ Request::is('seminarmhs') ? 'active-submenu' : '' }}">
          <i class="bi bi-calendar-event"></i> Seminar
        </a>
        <a href="/syaratseminarmhs/create"
          class="submenu-link {{ Request::is('syaratseminarmhs', 'syaratseminarmhs/*') ? 'active-submenu' : '' }}">
          <i class="bi bi-info-circle"></i> Syarat Seminar
        </a>
        <a href="/komprehensifmhs"
          class="submenu-link {{ Request::is('komprehensifmhs') ? 'active-submenu' : '' }}">
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
                  Pengurusan administrasi komprehensif paling lambat dilakukan 6 hari kerja sebelum pelaksanaan komprehensif (H-6). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar tidak melewati batas waktu yang telah ditentukan.
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
                  @if($syarat->alasan_makalah)<li><b>Draft Skripsi Komprehensif:</b> {{ $syarat->alasan_makalah }}</li>@endif
                  @if($syarat->alasan_bukti_sks)<li><b>Bukti Transkrip Nilai:</b> {{ $syarat->alasan_bukti_sks }}</li>@endif
                  @if($syarat->alasan_bukti_spp)<li><b>Bukti SPP:</b> {{ $syarat->alasan_bukti_spp }}</li>@endif
                  @if($syarat->alasan_bukti_kehadiran)<li><b>Bukti Kartu Bimbingan:</b> {{ $syarat->alasan_bukti_kehadiran }}</li>@endif
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
                  @if($syarat->alasan_makalah)
                    <div class="form-group">
                      <label>Upload Ulang Draft Skripsi Komprehensif <small class="text-danger">(*format wajib .PDF)</small></label>
                      <input type="file" name="makalah" accept=".pdf" required>
                    </div>
                  @endif
                  @if($syarat->alasan_bukti_sks)
                    <div class="form-group">
                      <label>Upload Ulang Transkrip Nilai <small class="text-danger">(*format wajib .PDF)</small></label>
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
                      <label>Upload Ulang Bukti Kartu Bimbingan Komprehensif <small class="text-danger">(*format wajib .PDF)</small></label>
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
                    <strong>BAP Anda telah diterima.</strong> Semua persyaratan komprehensif sudah lengkap dan disetujui.
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
                            <label>Upload Formulir Pendaftaran Komprehensif <small class="text-danger">(*format wajib .PDF)</small></label>
                            <input type="file" name="formulir" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>                      

                         <div class="form-group">
                            <label>Upload Draft Skripsi Komprehensif <small class="text-danger">(*format wajib .PDF)</small></label>
                            <input type="file" name="makalah" accept=".pdf" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti Transkrip Nilai <small class="text-danger">(*format wajib .PDF)</small></label>
                            <input type="file" name="bukti_sks" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti TF / SPP Lunas <small class="text-danger">(*format wajib .PDF)</small></label>
                            <input type="file" name="bukti_spp" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>                      

                        <div class="form-group">
                        <label>Upload Bukti Kartu Bimbingan <small class="text-danger">(*format wajib .PDF)</small></label>
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
@endpush
@endsection