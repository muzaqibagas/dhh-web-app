 @extends('layouts.apps')

 @section('content')

     @php
         $label = match ($jenis) {
             'kolokium' => 'Kolokium',
             'seminar' => 'Seminar Hasil',
             'komprehensif' => 'Komprehensif',
             default => 'Ujian',
         };
     @endphp
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
                     Request::is('kolokiummhs/*') ||
                     Request::is('seminarmhs/*') ||
                     Request::is('komprehensifmhs/*') ||
                     Request::is('syaratujian/*');
                 $isProfileMahasiswaActive =
                     Request::is('profilemhs') ||
                     Request::is('user/*/edit') ||
                     Request::is('profilemhs/edit') ||
                     Request::is('editpassmhs');
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
                 <a href="/kolokiummhs" class="submenu-link {{ Request::is('kolokiummhs') ? 'active-submenu' : '' }}">
                     <i class="bi bi-check2-circle"></i> Kolokium
                 </a>
                 <a href="{{ route('syaratujian.create', ['jenis' => 'kolokium']) }}"
                     class="submenu-link {{ request()->is('syaratujian/create') && request('jenis') == 'kolokium' ? 'active-submenu' : '' }}">
                     <i class="bi bi-info-circle"></i> Syarat Kolokium
                 </a>
                 <a href="/seminarmhs" class="submenu-link {{ Request::is('seminarmhs') ? 'active-submenu' : '' }}">
                     <i class="bi bi-calendar-event"></i> Seminar
                 </a>
                 <a href="{{ route('syaratujian.create', ['jenis' => 'seminar']) }}"
                     class="submenu-link {{ request()->routeIs('syaratujian.create') && request('jenis') == 'seminar' ? 'active-submenu' : '' }}">
                     <i class="bi bi-info-circle"></i> Syarat Seminar
                 </a>
                 <a href="/komprehensifmhs"
                     class="submenu-link {{ Request::is('komprehensifmhs') ? 'active-submenu' : '' }}">
                     <i class="bi bi-journal-text"></i> Komprehensif
                 </a>
                 <a href="{{ route('syaratujian.create', ['jenis' => 'komprehensif']) }}"
                     class="submenu-link {{ request()->routeIs('syaratujian.create') && request('jenis') == 'komprehensif' ? 'active-submenu' : '' }}">
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
                 <a href="/editpassmhs" class="submenu-link {{ Request::is('editpassmhs') ? 'active-submenu' : '' }}">
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
                 <h2 class="page-title">
                     Persyaratan
                     {{ match ($jenis) {
                         'kolokium' => 'Kolokium',
                         'seminar' => 'Seminar Hasil',
                         'komprehensif' => 'Komprehensif',
                         default => '-',
                     } }}
                 </h2>
                 {{-- Alert Error --}}
                 @if (session('error'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         {!! session('error') !!}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                 @endif
                 @if ($jenis == 'kolokium')
                     <ol class="syarat-list">
                         <li><b>Batas Waktu Pengurusan Administrasi</b><br>
                             Pengurusan administrasi seminar tugas akhir paling lambat dilakukan 4 hari kerja sebelum
                             pelaksanaan seminar (H-4). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar
                             tidak melewati batas waktu yang telah ditentukan.
                         </li>
                         <li><b>Formulir Pendaftaran Kolokium</b><br>
                             Mahasiswa diminta mengisi dan mengunggah foto formulir pendaftaran kolokium yang telah
                             ditandatangani oleh dosen pembimbing (dapat menggunakan Digsign IPB) dan kemudian diunggah
                             kembali melalui halaman ini. Setelah diterima, formulir akan disahkan oleh Ketua Departemen
                             melalui bagian Tata Usaha (TU).
                         </li>
                         <li><b>Makalah Kolokium</b><br>
                             Mahasiswa wajib mengunggah makalah kolokium (format .pdf) yang telah disetujui dan
                             ditandatangani oleh dosen pembimbing melalui halaman ini.
                         </li>
                         <li><b>Bukti Transkrip Nilai</b><br>
                             Lampirkan bukti jumlah transkrip nilai dengan total minimal 110 SKS.
                         </li>
                         <li><b>Bukti Pelunasan SPP</b><br>
                             Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada
                             halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan
                             jelas dan sudah dalam format .pdf
                         </li>
                         <li><b>Map Folio (4 Buah)</b><br>
                             Siapkan dan kumpulkan 4 buah map folio secara fisik ke bagian administrasi bersamaan dengan
                             makalah kolokium setelah semua dokumen diunggah secara daring.
                         </li>
                     </ol>
                 @elseif($jenis == 'seminar')
                     <ol class="syarat-list">
                         <li><b>Batas Waktu</b><br>
                             Pengurusan administrasi seminar tugas akhir paling lambat dilakukan 4 hari kerja sebelum
                             pelaksanaan seminar (H-4). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar
                             tidak melewati batas waktu yang telah ditentukan.
                         </li>
                         <li><b>Jumlah Kehadiran Seminar</b><br>
                             Mahasiswa hanya dapat mendaftar seminar setelah memenuhi jumlah minimal kehadiran, yaitu 10
                             kali seminar di Departemen Hasil Hutan dan 5 kali seminar di luar Departemen Hasil Hutan.
                         </li>
                         <li><b>Telah Menyelesaikan Seluruh Mata Kuliah</b><br>
                             Mahasiswa harus membawa dokumen bukti telah menyelesaikan seluruh mata kuliah wajib, pilihan
                             minor/supporting course termasuk Kolokium, dengan jumlah minimal 137 SKS dan memiliki IPK
                             keseluruhan minimal 2,00 tanpa nilai E.
                         </li>
                         <li><b>Formulir Pendaftaran Seminar</b><br>
                             Mahasiswa wajib mengisi formulir pendaftaran seminar di halaman Seminar. Setelah diisi,
                             formulir tersebut harus ditandatangani oleh dosen pembimbing (dapat menggunakan Digsign IPB)
                             dan kemudian diunggah kembali melalui halaman ini. Setelah diterima, formulir akan disahkan
                             oleh Ketua Departemen melalui bagian Tata Usaha (TU).
                         </li>
                         <li><b>Makalah Seminar</b><br>
                             Mahasiswa wajib mengunggah makalah seminar (format .pdf) yang telah disetujui dan
                             ditandatangani oleh dosen pembimbing melalui halaman ini.
                         </li>
                         <li><b>Bukti Pelunasan SPP</b><br>
                             Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada
                             halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan
                             jelas dan sudah dalam format .pdf
                         </li>
                         <li><b>Dokumen hardfile yang Diserahkan ke TU</b><br>
                             Selain dokumen yang diunggah secara daring, mahasiswa juga harus menyerahkan secara langsung ke
                             bagian TU beberapa dokumen berikut:<br>
                             - Bukti penyerahan proposal penelitian<br>
                             - Makalah seminar (1 eksemplar) yang telah diparaf oleh dosen pembimbing<br>
                             - 4 buah map folio<br>
                             - 10 buah amplop putih
                         </li>
                     </ol>
                 @elseif($jenis == 'komprehensif')
                     <ol class="syarat-list">
                         <li><b>Batas Waktu</b><br>
                             Pengurusan administrasi komprehensif paling lambat dilakukan 6 hari kerja sebelum pelaksanaan
                             komprehensif (H-6). Mahasiswa disarankan segera melengkapi seluruh persyaratan agar tidak
                             melewati batas waktu yang telah ditentukan.
                         </li>
                         <li><b>Formulir Pendaftaran Ujian Akhir Sarjana</b><br>
                             Mahasiswa diminta mengisi formulir pendaftaran di halaman Komprehesif dan meminta tanda tangan
                             dosen pembimbing (dapat menggunakan Digsign IPB) dan mengunggah file tersebut di halaman ini.
                             Formulir ini akan disahkan oleh Ketua Departemen oleh pihak TU.
                         </li>
                         <li><b>Telah Menyelesaikan Seluruh Mata Kuliah.</b><br>
                             Mahasiswa diminta mengunggah file dokumen bukti telah menyelesaikan seluruh mata kuliah yang
                             telah ditetapkan di halaman ini. termasuk seminar, dengan jumlah minimal 138 SKS dan IPK
                             keseluruhan minimal 2,00 tanpa nilai E.
                         </li>
                         <li><b>Bukti Pelunasan SPP</b><br>
                             Bukti pembayaran SPP untuk semester berjalan harus diunggah melalui form yang tersedia pada
                             halaman ini. Jika menggunakan tangkapan layar, pastikan informasi pembayaran terlihat dengan
                             jelas dan sudah dalam format .pdf
                         </li>
                         </li>
                         <li><b>Buku Konsultasi</b><br>
                             Mahasiswa diminta menyerahkan buku konsultasi yang telah diisi lengkap dan ditandatangani oleh
                             dosen pembimbing (wajib diserahkan secara fisik ke bagian TU).
                         </li>
                         <li><b>Draft Skripsi yang Siap Ujian</b><br>
                             Mahasiswa diminta membawa draft skripsi yang telah ditandatangani oleh Komisi Pembimbing dan
                             Ketua Departemen. (Sebanyak 3-4 eksemplar wajib diserahkan secara fisik ke bagian TU).
                         </li>
                         <li><b>Proceeding dan Ringkasan (CD & Hardcopy)</b><br>
                             Mahasiswa diminta membawa proceeding (berbahasa Inggris) dan ringkasan skripsi dalam bentuk CD
                             serta 1 lembar hardcopy masing-masing (wajib diserahkan secara fisik ke bagian TU).
                         </li>
                     </ol>
                 @endif

                 <!-- {{-- Kondisi jika sudah disetujui --}} -->
                 @if ($syarat && $syarat->status === 'disetujui')
                     <div class="alert alert-success">
                         Dokumen Anda sudah <b>disetujui</b>. Anda tidak bisa upload lagi, silahkan melaksanakan
                         {{ $label }}.
                     </div>

                     <!-- {{-- Kondisi jika ditolak --}} -->
                 @elseif($syarat && $syarat->status === 'ditolak')
                     <div class="alert alert-warning">
                         Dokumen Anda <b>ditolak</b>. Silakan perbaiki dan upload ulang dokumen berikut:
                         <ul>
                             @if ($syarat->alasan_formulir)
                                 <li><b>Formulir {{ $label }}:</b> {{ $syarat->alasan_formulir }}</li>
                             @endif
                             @if ($syarat->alasan_makalah)
                                 <li><b>Makalah {{ $label }}:</b> {{ $syarat->alasan_makalah }}</li>
                             @endif
                             @if ($syarat->alasan_bukti_sks)
                                 <li><b>Bukti Transkrip Nilai:</b> {{ $syarat->alasan_bukti_sks }}</li>
                             @endif
                             @if ($syarat->alasan_bukti_spp)
                                 <li><b>Bukti SPP:</b> {{ $syarat->alasan_bukti_spp }}</li>
                             @endif
                             @if ($syarat->alasan_bukti_kehadiran)
                                 <li><b>Bukti Kehadiran {{ $label }}:</b> {{ $syarat->alasan_bukti_kehadiran }}
                                 </li>
                             @endif
                         </ul>
                     </div>

                     <!-- {{-- Form reupload --}} -->
                     <div class="upload-section">
                         <h4><i class="bi bi-upload"></i> Upload Ulang Dokumen Ditolak</h4>
                         <form action="{{ route('syaratujian.reupload', $syarat->id) }}" method="POST"
                             enctype="multipart/form-data">
                             @csrf
                             <input type="hidden" name="jenis_ujian" value="{{ $jenis }}">

                             @if ($syarat->alasan_formulir)
                                 <div class="form-group">
                                     <label>Upload Ulang Formulir {{ $label }} <small class="text-danger">(*format
                                             wajib .PDF)</small></label>
                                     <input type="file" name="formulir" accept=".pdf" required>
                                 </div>
                             @endif
                             @if ($syarat->alasan_makalah)
                                 <div class="form-group">
                                     <label>Upload Ulang makalah {{ $label }} <small class="text-danger">(*format
                                             wajib .PDF)</small></label>
                                     <input type="file" name="makalah" accept=".pdf" required>
                                 </div>
                             @endif
                             @if ($syarat->alasan_bukti_sks)
                                 <div class="form-group">
                                     <label>Upload Ulang Bukti Transkrip Nilai<small class="text-danger">(*format wajib
                                             .PDF)</small></label>
                                     <input type="file" name="bukti_sks" accept=".pdf" required>
                                 </div>
                             @endif
                             @if ($syarat->alasan_bukti_spp)
                                 <div class="form-group">
                                     <label>Upload Ulang Bukti SPP <small class="text-danger">(*format wajib
                                             .PDF)</small></label>
                                     <input type="file" name="bukti_spp" accept=".pdf" required>
                                 </div>
                             @endif
                             @if ($syarat->alasan_bukti_kehadiran)
                                 <div class="form-group">
                                     <label>Upload Ulang Bukti Kehadiran {{ $label }} <small
                                             class="text-danger">(*format wajib .PDF)</small></label>
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
                         Dokumen Anda sedang <b>menunggu konfirmasi admin</b>. Anda tidak dapat mengupload dokumen baru
                         sampai dikonfirmasi.
                     </div>

                     <!-- {{-- kondisi kalau BAP diterima --}} -->
                 @elseif ($syarat && $syarat->bap === 'diterima')
                     <div class="alert alert-success">
                         <strong>BAP Anda telah diterima.</strong> Semua persyaratan kolokium sudah lengkap dan disetujui.
                     </div>

                     <!-- {{-- kondisi kalau BAP ditolak --}} -->
                 @elseif ($syarat && $syarat->bap === 'ditolak' && !$syarat->formulir)
                     <div class="alert alert-warning">
                         <strong>BAP Anda ditolak.</strong> Silakan unggah ulang<strong>Formulir
                             {{ $label }}</strong> dengan jadwal baru untuk penjadwalan ulang.
                         <ul>
                             @if ($syarat->alasan_formulir)
                                 <li><b>Formulir {{ $label }}:</b> {{ $syarat->alasan_formulir }}</li>
                             @endif
                         </ul>
                     </div>

                     <!-- {{-- Kondisi default (belum pernah upload) --}} -->
                 @else
                     <div class="upload-section">
                         <h4><i class="bi bi-upload"></i> Form Upload Dokumen</h4>
                         @if ($errors->any())
                             <div class="alert alert-danger">
                                 <ul>
                                     @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                     @endforeach
                                 </ul>
                             </div>
                         @endif
                         <form action="{{ route('syaratujian.store') }}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <input type="hidden" name="jenis_ujian" value="{{ $jenis }}">

                             <div class="form-group">
                                 <label>Upload Formulir Pendaftaran {{ $label }} <small
                                         class="text-danger">(*format wajib .PDF)</small></label>
                                 <input type="file" name="formulir" accept=".pdf" required>
                             </div>

                             <div class="form-group">
                                 <label>Upload Makalah {{ $label }} <small class="text-danger">(*format wajib
                                         .PDF)</small></label>
                                 <input type="file" name="makalah" accept=".pdf" required>
                             </div>

                             <div class="form-group">
                                 <label>Upload Bukti Transkrip Nilai <small class="text-danger">(*format wajib
                                         .PDF)</small></label>
                                 <input type="file" name="bukti_sks" accept=".pdf" required>
                             </div>

                             <div class="form-group">
                                 <label>Upload Bukti TF / SPP Lunas <small class="text-danger">(*format wajib
                                         .PDF)</small></label>
                                 <input type="file" name="bukti_spp" accept=".pdf" required>
                             </div>

                             <div class="form-group">
                                 <label>Upload Bukti Kehadiran {{ $label }} <small class="text-danger">(*format
                                         wajib .PDF)</small></label>
                                 <input type="file" name="bukti_kehadiran" accept=".pdf" required>
                             </div>
                             <div class="form-actions"><button type="submit" class="btn-submit">Simpan</button></div>
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
