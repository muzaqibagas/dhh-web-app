@extends('layouts.apps')

@section('content')

<div class="main-container">
    <aside class="sidebar">
        <a href="" class="menu-image-only">
        <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
        </a>
        <!-- Untuk aktifin button sub menu ========================= -->
        @php
        $isDashboardActive = Request::is('dashboardadm');
        
        $isRecapdataActive = Request::is('recapdata*');

        $isAdminProfileActive = Request::is('admprofile') || Request::is('user/*/edit') || Request::is('editpassadm') || Request::is('logoutadmprofile');

        $isRubrikActive = Request::is('rubrik*');
        
        $isTingkatAkhirActive = 
            Request::is('syaratkolokiummhs') || Request::is('syaratkolokiummhs*') ||
            Request::is('syaratseminarmhs') || Request::is('syaratseminarmhs*') ||
            Request::is('syaratkomprehensifmhs') || Request::is('syaratkomprehensifmhs*');

        $isKontenActive = 
            Request::is('kategorigaleri*') ||
            Request::is('galeri*') ||
            Request::is('kategoriartikel*') ||
            Request::is('artikel*') ||
            Request::is('review-alumni*') ||
            Request::is('konten-dept*') ||
            Request::is('kontenjenjang*') ||
            Request::is('mitra*');

        $isStaffDeptActive = 
            Request::is('kategoristaff*') ||
            Request::is('staff-dept*') ||
            Request::is('ketuadhh*');
        @endphp

        <!-- BTN Dashboard ===================== -->
        <a href="/dashboardadm" class="menu {{ $isDashboardActive ? 'active' : '' }}">
        <div class="menu-left">
            <i class="bi bi-graph-up"></i> <span> Dashboard </span>
        </div>
        <span class="dropdownArrow"></span>
        </a>

        <!-- BTN RECAP DATA ===================== -->
        <a href="/recapdata" class="menu {{ $isRecapdataActive ? 'active' : '' }}">
        <div class="menu-left">
            <i class="bi bi-database-check"></i> <span> Recap Data </span>
        </div>
        <span class="dropdownArrow"></span>
        </a>

        <!-- BTN RUBRIK ===================== -->
        <a href="{{ route('rubrik.index') }}" class="menu {{ $isRubrikActive ? 'active' : '' }}">
            <div class="menu-left">                
                <i class="bi bi-journal-check"></i><span> Rubrik </span>
            </div>
            <span class="dropdownArrow"></span>
        </a>

        <!-- BTN PENILAIAN ===================== -->
        <a href="{{ route('penilaianadm.index') }}" class="menu {{ Request::is('penilaianadm*') ? 'active' : '' }}">
        <div class="menu-left">
            <i class="bi bi-file-earmark-bar-graph-fill"></i> <span> Penilaian </span>
        </div>
        <span class="dropdownArrow"></span>
        </a>        

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

        {{-- KOLOKIUM --}}
        <a href="{{ route('syaratujian.index', ['jenis' => 'kolokium']) }}"
            class="submenu-link {{ request('jenis') == 'kolokium' ? 'active-submenu' : '' }}">
            <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
        </a>

        {{-- SEMINAR --}}
        <a href="{{ route('syaratujian.index', ['jenis' => 'seminar']) }}"
            class="submenu-link {{ request('jenis') == 'seminar' ? 'active-submenu' : '' }}">
            <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
        </a>

        {{-- KOMPRE --}}
        <a href="{{ route('syaratujian.index', ['jenis' => 'komprehensif']) }}"
            class="submenu-link {{ request('jenis') == 'komprehensif' ? 'active-submenu' : '' }}">
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
            class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit', 'konten-dept/create') ? 'active-submenu' : '' }}">
            <i class="bi bi-laptop"></i> Konten Departemen
        </a>
        <a href="/kontenjenjang"
            class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit', 'kontenjenjang/create') ? 'active-submenu' : '' }}">
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
        <a href="#" class="menu {{ $isAdminProfileActive ? 'active' : '' }}" data-dropdown="admprofile">
        <div class="menu-left">
            <i class="bi bi-person-badge"></i>
            <span> Profil Admin </span>
        </div>
        <span class="dropdownArrow" data-arrow="admprofile">
            {!! $isAdminProfileActive ? '&#9660;' : '&#9650;' !!}
        </span>
        </a>
        <div data-menu="admprofile"
        style="margin-left:24px; flex-direction:column; {{ $isAdminProfileActive ? 'display:flex;' : 'display:none;' }}">
        <a href="/admprofile"
            class="submenu-link {{ Request::is('admprofile', 'user/*/edit') ? 'active-submenu' : '' }}">
            <i class="bi bi-person-workspace"></i> Detail Profil Admin
        </a>
        <a href="/editpassadm"
            class="submenu-link {{ Request::is('editpassadm') ? 'active-submenu' : '' }}">
            <i class="bi bi-gear-wide-connected"></i> Edit Password
        </a>
        <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" class="submenu-link w-100 text-start{{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
                <i class="bi bi-box-arrow-right"></i> Log Out
            </button>
        </form>        
    </aside>

    <main class="content">    
        <div class="card text-start mb-4 p-4" style="background:#f3f4f6;">
            <h2 style="font-size:18px; color:#1e3a8a;">
                Informasi Mahasiswa
            </h2>

            <table class="info-table">
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td>:</td>
                    <td>{{ $data->mahasiswa->nama ?? '-' }}</td>
                </tr>

                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $data->mahasiswa->nim ?? '-' }}</td>
                </tr>

                <tr>
                    <td>Judul TA</td>
                    <td>:</td>
                    <td>{{ $judul }}</td>
                </tr>

                <tr>
                    <td>Jenis Ujian</td>
                    <td>:</td>
                    <td>{{ ucfirst($jenis) }}</td>
                </tr>
            </table>
        </div>

        @forelse($penilaianPerDosen as $group => $items)
        @php
            $first = $items->first();

            if($first->id_moderator){
                $namaDosen = $first->moderator->nama ?? '-';
                $role = 'Moderator';
            }
            elseif($first->id_penguji){
                $namaDosen = $first->penguji->nama ?? '-';
                $role = 'Penguji';
            }
            elseif($first->id_pembimbing1){
                $namaDosen = $first->pembimbing1->nama ?? '-';
                $role = 'Pembimbing 1';
            }
            elseif($first->id_pembimbing2){
                $namaDosen = $first->pembimbing2->nama ?? '-';
                $role = 'Pembimbing 2';
            }
            else{
                $namaDosen = '-';
                $role = '-';
            }
        @endphp
        
        <div class="card text-start mb-4 p-4">

            {{-- HEADER DOSEN --}}
            <div style="
                background:#dbeafe;
                padding:14px 18px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                <h4 style="margin:0; color:#1e3a8a;">
                    {{ $namaDosen }}
                </h4>

                <small style="color:#475569;">
                    {{ $role }}
                </small>
            </div>
            
            <table style="
                width:100%;
                border-collapse:collapse;
                background-color:#ffffff;
                border-radius:8px;
                overflow:hidden;
                box-shadow:0 2px 10px rgba(0,0,0,0.08);
            ">

                <thead style="background-color:#1e3a8a; color:#ffffff;">
                    <tr>
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">No</th>
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Komponen Penilaian</th>
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Bobot</th>
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Nilai</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $index => $penilaian)
                    <tr style="background-color:#ffffff;">
                        <td style="padding:12px;">{{ $index + 1 }}</td>
                        <td style="padding:12px;">{{ $penilaian->rubrik->nama_kriteria ?? '-' }}</td>
                        <td style="padding:12px;">{{ $penilaian->rubrik->bobot ?? '-' }}%</td>
                        <td style="padding:12px;">
                            @php
                                $nilaiMap = [
                                    1 => '1 - Kurang',
                                    2 => '2 - Cukup',
                                    3 => '3 - Baik',
                                    4 => '4 - Sangat Baik'
                                ];
                            @endphp
                            {{ $nilaiMap[$penilaian->nilai] ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="margin-top:16px; margin-bottom:16px; padding:14px; background:#eef2ff; border-radius:8px; font-size:14px;">                
                <strong>Total Nilai Akhir:</strong>

                {{ $items->first()->nilai_akhir !== null ? number_format($items->first()->nilai_akhir, 2) : '-' }}
            </div>
            
            @if($items->first()->catatan)
            <div style="margin-top:20px;">
                <h2 style="margin-top:0; font-size:18px; color:#1e3a8a;">Catatan / Saran Perbaikan</h2>
                <div style="
                    width:100%;
                    padding:12px;
                    background-color:#f9fafb;
                    border:1px solid #e5e7eb;
                    border-radius:6px;
                    font-size:14px;
                ">
                    {{ $items->first()->catatan }}
                </div>
            </div>
            @endif
        </div>
        @empty

        <div class="card text-start mb-4 p-4">
            Tidak ada data penilaian.
        </div>
        @endforelse

        {{-- REKAP NILAI --}}
        <div class="card text-start mb-4 p-4">
            <h4 style="color:#1e3a8a;">
                Rekap Nilai Dosen
            </h4>

            <table style="
                width:100%;
                border-collapse:collapse;
                margin-top:20px;
            ">

                <thead style="background:#1e3a8a; color:white;">

                    <tr>
                        <th style="padding:12px;">No</th>
                        <th style="padding:12px;">Nama Dosen</th>
                        <th style="padding:12px;">Role</th>
                        <th style="padding:12px;">Nilai Akhir</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($nilaiPerDosen as $i => $item)

                    <tr style="border-bottom:1px solid #e5e7eb;">

                        <td style="padding:12px;">
                            {{ $i + 1 }}
                        </td>

                        <td style="padding:12px;">
                            {{ $item['nama_dosen'] }}
                        </td>

                        <td style="padding:12px;">
                            {{ $item['role'] }}
                        </td>

                        <td style="padding:12px;">
                            {{ number_format($item['nilai_akhir'], 2) }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div style="
                margin-top:20px;
                padding:16px;
                background:#dcfce7;
                border-radius:8px;
            ">

                <div class="mb-2">
                    <strong>Total Nilai:</strong>
                    {{ number_format($totalNilai, 2) }}
                </div>

                <div>
                    <strong>Rata-rata Nilai:</strong>
                    {{ number_format($rataRata, 2) }}
                </div>

            </div>

        </div>

    </main>
</div>
@endsection
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