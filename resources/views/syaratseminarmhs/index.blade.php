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
      $isTingkatAkhirActive = 
        Request::is('undangan') || Request::is('undangankolokium') || Request::is('undanganseminar') || Request::is('undangansidang') || 
        Request::is('kolokium') || 
        Request::is('seminar') || 
        Request::is('sidang');
      $isKontenActive = 
        Request::is('kategorigaleri') || Request::is('kategorigaleri/create') || Request::is('kategorigaleri/*/edit') || 
        Request::is('galeri') || Request::is('galeri/create') || Request::is('galeri/*/edit') || 
        Request::is('kategoriartikel') || Request::is('kategoriartikel/create') || Request::is('kategoriartikel/*/edit') || 
        Request::is('artikel') || Request::is('artikel/create') || Request::is('artikel/*/edit') || 
        Request::is('review-alumni') || Request::is('review-alumni/create') || Request::is('review-alumni/*/edit') |
        Request::is('konten-dept') || Request::is('konten-dept/show') || Request::is('konten-dept/*/edit') || 
        Request::is('kontenjenjang') || Request::is('kontenjenjang/show') || Request::is('kontenjenjang/*/edit') || 
        Request::is('mitra'); Request::is('mitra/create') || Request::is('mitra/*/edit') || 
      $isStaffDeptActive = 
        Request::is('kategoristaff') || Request::is('kategoristaff/create') || Request::is('kategoristaff/*/edit') |
        Request::is('staff-dept') || Request::is('staff-dept/create') || Request::is('staff-dept/*/edit') |
        Request::is('ketuadhh') || Request::is('ketuadhh/create') || Request::is('ketuadhh/*/edit');
      @endphp

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
      <a href="/undangan"
        class="submenu-link {{ Request::is('undangan', 'undangankolokium', 'undanganseminar', 'undangansidang') ? 'active-submenu' : '' }}">
        <i class="bi bi-envelope-open"></i> Undangan
      </a>
      <a href="/kolokium"
        class="submenu-link {{ Request::is('kolokium') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
      </a>
      <a href="/seminar"
        class="submenu-link {{ Request::is('seminar') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
      </a>
      <a href="/sidang"
        class="submenu-link {{ Request::is('sidang') ? 'active-submenu' : '' }}">
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
        class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit') ? 'active-submenu' : '' }}">
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
    <a href="/admprofile" class="menu">
      <div class="menu-left">
        <i class="bi bi-person-badge"></i> <span> Profil Admin </span>
      </div>
      <span class="dropdownArrow"></span>
    </a>
    <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
  
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
  </aside>
  
  <!-- MAIN CONTENT -->
  <main class="content">
    <div class="container-fluid mt-4">
        <div class="adm-header">
            <h2 class="adm-title">Data Pendaftar Seminar</h2>
            <div class="d-flex justify-content-end align-items-center gap-2">                    
              <form action="{{ route('syaratseminarmhs.index') }}" method="GET" class="d-flex justify-content-end align-items-center gap-2 w-100">
                <input type="text" name="search" class="form-control w-100" placeholder="Cari Mahasiswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-3">
                  <i class="bi bi-search"></i>
                </button>
              </form>              
            </div> 
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered align-middle mb-0">
                      <thead class="table-light">
                          <tr>
                              <th class="text-center align-middle" style="width: 10%;">Nama</th>
                              <th class="text-center align-middle" style="width: 10%;">Form Seminar</th>                              
                              <th class="text-center align-middle" style="width: 10%;">Bukti 110 SKS</th>
                              <th class="text-center align-middle" style="width: 10%;">Bukti SPP</th>
                              <th class="text-center align-middle" style="width: 10%;">Kartu Kehadiran</th>
                              <th class="text-center align-middle" style="width: 10%;">Verifikasi</th>                              
                              <th class="text-center align-middle" style="width: 10%;">Undangan</th>
                              <th class="text-center align-middle" style="width: 10%;">BAP</th>
                          </tr>
                      </thead>
                      <tbody>
                        @forelse ($pendaftar as $pendaftars)
                        <tr>
                          <td class="align-middle text-center">{{ $pendaftars->mahasiswa->nama }}</td>
                          <td class="align-middle text-center">
                            @if($pendaftars->formulir)
                              <a href="{{ route('syaratseminarmhs.show', $pendaftars->id) }}" class="btn btn-primary btn-sm d-flex flex-column align-items-center mx-auto" style="width: 90px; height: 30px; padding: 0;">                                                                                                                          
                                <p class="bi bi-eye" style="font-size: 18px;"> Lihat</p>
                              </a>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            @if($pendaftars->bukti_sks)
                              <a href="{{asset($pendaftars->bukti_sks)}}" target="_blank" class="btn btn-primary btn-sm d-flex flex-column align-items-center mx-auto" style="width: 90px; height: 30px; padding: 0;">                            
                                <p class="bi bi-eye" style="font-size: 18px"> Lihat</p> 
                              </a>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            @if($pendaftars->bukti_spp)
                              <a href="{{asset($pendaftars->bukti_spp)}}" target="_blank" class="btn btn-primary btn-sm d-flex flex-column align-items-center mx-auto" style="width: 90px; height: 30px; padding: 0;">                            
                                <p class="bi bi-eye" style="font-size: 18px;"> Lihat</p>
                              </a>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            @if($pendaftars->bukti_kehadiran)
                              <a href="{{asset($pendaftars->bukti_kehadiran)}}" target="_blank" class="btn btn-primary btn-sm d-flex flex-column align-items-center mx-auto" style="width: 90px; height: 30px; padding: 0;">
                                <p class="bi bi-eye" style="font-size: 18px;"> Lihat</p> 
                              </a>
                            @endif
                          </td>
                          <td>     
                            @if ($pendaftars->status == 'pending')                           
                              <button type="button" class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSetujui{{ $pendaftars->id }}"
                                    style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-check-lg" style="font-size: 18px;"></i>
                              </button>
                              <button type="button" class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalTolak{{ $pendaftars->id }}"
                                    style="width: 30px; height: 30px; padding: 0;">
                                <i class="bi bi-x-lg" style="font-size: 18px;"></i>
                              </button>
                            @elseif ($pendaftars->status == 'disetujui')
                              <span class="text-success fw-bold">Disetujui</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('undangan.seminar.pdf', $pendaftars->id) }}" class="btn btn-primary">Download</a>                              
                          </td>
                          <td class="text-center">
                            @if ($pendaftars->status === 'disetujui')
                              @if ($pendaftars->bap == 'belum_melaksanakan')                                
                                <button type="button" class="btn btn-success btn-sm"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalBapDiterima{{ $pendaftars->id }}"
                                      style="width: 30px; height: 30px; padding: 0;">
                                  <i class="bi bi-check-lg" style="font-size: 18px;"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalBapDitolak{{ $pendaftars->id }}"
                                      style="width: 30px; height: 30px; padding: 0;">
                                  <i class="bi bi-x-lg" style="font-size: 18px;"></i>
                                </button>
                              @elseif ($pendaftars->bap == 'diterima')
                                <span class="text-success fw-bold">Diterima</span>
                              @elseif ($pendaftars->bap == 'ditolak')
                                <span class="text-danger fw-bold">Ditolak</span>
                              @endif
                            @else
                              <button type="button" class="btn btn-secondary btn-sm" disabled
                                      title="Verifikasi belum disetujui"
                                      style="width: 90px; height: 30px; padding: 0;">
                                <i class="bi bi-lock" style="font-size: 16px;"></i> Terkunci
                              </button>
                            @endif
                          </td>
                        </tr>

                        <div class="modal fade" id="modalSetujui{{ $pendaftars->id }}" tabindex="-1" aria-labelledby="modalSetujuiLabel{{ $pendaftars->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="modalSetujuiLabel{{ $pendaftars->id }}">Konfirmasi Persetujuan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                              </div>
                              <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                                <i class="bi bi-emoji-smile-fill text-success" style="font-size: 4rem;"></i>
                                <div>Apakah Anda yakin ingin <strong>menyetujui</strong> pendaftaran seminar atas nama <strong>{{ $pendaftars->mahasiswa->nama }}</strong>?</div>
                              </div>                
                              <div class="modal-footer justify-content-center">                
                                <form action="{{ route('syaratseminarmhs.setujui', $pendaftars->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-success">Ya, Setujui</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="modal fade" id="modalTolak{{ $pendaftars->id }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $pendaftars->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalTolakLabel{{ $pendaftars->id }}">Konfirmasi Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                              </div>
                              <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                                <!-- <i class="bi bi-emoji-frown-fill text-danger" style="font-size: 4rem;"></i> -->
                                <div>Apakah Anda yakin ingin <strong>menolak</strong> pendaftaran kolokium atas nama <strong>{{ $pendaftars->mahasiswa->nama }}</strong>?</div>
                              </div>
                              <div class="modal-footer justify-content-center">                                  
                                <form action="{{ route('syaratseminarmhs.tolak', $pendaftars->id) }}" method="POST">
                                  @csrf                                                                                                                                               
                                    <div class="mb-3 mx-3 d-flex gap-2">
                                      <textarea name="alasan_formulir" class="form-control mb-2" placeholder="Alasan tolak formulir..."></textarea>
                                      <textarea name="alasan_bukti_sks" class="form-control mb-2" placeholder="Alasan tolak bukti SKS..."></textarea>
                                    </div>
                                    <div class="mb-3 mx-3 d-flex gap-2">
                                      <textarea name="alasan_bukti_spp" class="form-control mb-2" placeholder="Alasan tolak bukti SPP..."></textarea>
                                      <textarea name="alasan_bukti_kehadiran" class="form-control mb-2" placeholder="Alasan tolak bukti kehadiran..."></textarea>
                                    </div>                                                                            
                                    <button type="submit" class="btn btn-danger">Tolak</button>                                      
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>      

                        <!-- Modal BAP Diterima -->
                        <div class="modal fade" id="modalBapDiterima{{ $pendaftars->id }}" tabindex="-1" aria-labelledby="modalBapDiterimaLabel{{ $pendaftars->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="modalBapDiterimaLabel{{ $pendaftars->id }}">Konfirmasi BAP Diterima</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                              </div>
                              <div class="modal-body text-center">
                                 <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                <p>Apakah Anda yakin sudah <strong>menerima</strong> BAP Seminar Hasil Mahasiswa <strong>{{ $pendaftars->mahasiswa->nama }}</strong>?</p>
                              </div>
                              <div class="modal-footer justify-content-center">
                                <form action="{{ route('syaratseminarmhs.bap.diterima', $pendaftars->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-success">Ya, Terima</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal BAP Ditolak -->
                        <div class="modal fade" id="modalBapDitolak{{ $pendaftars->id }}" tabindex="-1" aria-labelledby="modalBapDitolakLabel{{ $pendaftars->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalBapDitolakLabel{{ $pendaftars->id }}">Konfirmasi BAP Ditolak</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                              </div>
                              <div class="modal-body text-center">
                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                                <p>Apakah Anda yakin <strong>belum menerima</strong> BAP untuk <strong>{{ $pendaftars->mahasiswa->nama }}</strong> dan mengharuskan mahasiswa melakukan seminar kembali?</p>
                              </div>
                              <div class="modal-footer justify-content-center">
                                <form action="{{ route('syaratseminarmhs.bap.ditolak', $pendaftars->id) }}" method="POST">                                                        
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @empty
                          <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada mahasiswa seminar hasil.</td>
                          </tr>
                        @endforelse
                      </tbody>
                  </table>
              </div>              
            </div>          
        </div>
    </div>
  </main>
</div>
@endsection