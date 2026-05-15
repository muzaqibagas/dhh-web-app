@extends('layouts.apps')

@section('content')
    <!-- SIDEBAR -->
    <div class="main-container">
        <aside class="sidebar">
            <div class="d-flex align-items-center menu pb-0 mb-0 pt-0 mt-0">
                <h5 class="fw-bold" style="color: #721B29">{{ Auth::guard('staff')->user()->nama ?? 'Guest' }}</h5>
            </div>
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>
            <!-- Untuk aktifin button sub menu ========================= -->
            @php
                $isDashboardActive = Request::is('dashboarddosen');
                $isJadwalTAActive = Request::is('jadwalta');
                $isPenilaianActive = Request::is('penilaian');
                $isFormulirLayananActive = Request::is('formulirlayananakademikmhs');
                $isProfileMahasiswaActive =
                    Request::is('profiledosen') ||
                    Request::is('user/*/edit') ||
                    Request::is('profiledosen/edit') ||
                    Request::is('editpassdosen');
                $isLogoutmhsActive = Request::is('logoutmhs');
            @endphp

            <!-- BTN BERANDA ===================== -->
            <a href="{{ route('dashboarddosen.index') }}" class="menu {{ $isDashboardActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-house-door-fill"></i>
                    <span> Beranda </span>
                </div>
            </a>
            <a href="{{ route('jadwalta.index') }}" class="menu {{ $isJadwalTAActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span> Jadwal TA </span>
                </div>
            </a>
            <a href="{{ route('penilaian.index') }}" class="menu {{ $isPenilaianActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    <span> Penilaian </span>
                </div>
            </a>

            <!-- PEMBATAS EMAS ===================== -->
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>

            <!-- BTN Profile MHS ===================== -->
            <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profiledosen">
                <div class="menu-left">
                    <i class="bi bi-person"></i>
                    <span> Profil Dosen </span>
                </div>
                <span class="dropdownArrow" data-arrow="profiledosen">
                    {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="profiledosen"
                style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/profiledosen"
                    class="submenu-link {{ Request::is('profile', 'profiledosen/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-person-workspace"></i> Biodata Dosen
                </a>
                <a href="/editpassdosen" class="submenu-link {{ Request::is('editpassdosen') ? 'active-submenu' : '' }}">
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
            <div class="welcome-card">
                <div class="d-flex flex-column">
                    <h2>Halo, {{ Auth::guard('staff')->user()->nama ?? 'Guest' }}!</h2>
                </div>

                <p class="welcome-text">
                    Selamat datang di <b>Layanan Akademik Departemen Hasil Hutan</b>. </br>
                    Pantau aktivitas akademik mahasiswa bimbingan Anda, kelola pengajuan kolokium dan seminar, serta akses
                    penilaian mahasiswa dan dokumen penting secara cepat dan terstruktur.
                </p>
            </div>

            <div class="status-cards">
                <div class="pengumuman">
                    <h4><i class="bi bi-megaphone"></i> Notifikasi</h4>
                    <div class="overflow-auto" style="max-height: 300px;">
                        @forelse($notifications as $notif)
                            <a href="{{ route('staff-notification.open', $notif->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="card text-start mb-2 p-2"
                                    @if (!$notif->is_read) style="background-color: #013880; color: #fff;" @endif>
                                    <h6><b>{{ $notif->title }}</b><br></h6>
                                    <h6>{!! $notif->message !!}</h6>
                                    <div class="text-muted"
                                        @if (!$notif->is_read) style="color: #7e7e7eff !important; font-size: 12px" @endif>
                                        {{ $notif->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="card text-start p-2">Tidak ada notifikasi</div>
                        @endforelse
                    </div>
                </div>
                <div class="status-cards-left">
                    <div class="card">
                        <i class="bi bi-journal-check"></i>
                        <h5>Mahasiswa Dijadwalkan</h5>
                        <p class="status">
                            <span class="#">5</span>
                        </p>
                    </div>

                    <div class="card">
                        <i class="bi bi-calendar-event"></i>
                        <h5>Penilaian Belum Selesai</h5>
                        <p class="status">
                            <span class="#">6</span>
                        </p>
                    </div>
                    <div class="card sidang-full">
                        <i class="bi bi-file-earmark-text"></i>
                        <h5>Penilaian Selesai</h5>
                        <p class="status">
                            <span class="#">3</span>
                        </p>
                    </div>
                </div>
            </div>

            <table
                style="
          width:100%;
          border-collapse:collapse;
          background-color:#ffffff;
          border-radius:8px;
          overflow:hidden;
          box-shadow:0 2px 6px rgba(0,0,0,0.08);
          margin-top:20px;
      ">
                <thead style="background-color:#1e3a8a; color:#ffffff;">
                    <tr>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Nama Mahasiswa</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">NIM</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Jenis Ujian</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Peran Anda</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Tanggal</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Status</th>
                        <th style="padding:12px 14px; text-align:left; font-size:14px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr style="background-color:#ffffff;">
                            <td style="padding:12px 14px; font-size:14px;">{{ $item->mahasiswa->nama ?? '-' }}</td>
                            <td style="padding:12px 14px; font-size:14px;">{{ $item->mahasiswa->nim ?? '-' }}</td>
                            <td style="padding:12px 14px; font-size:14px;">{{ $item->jenis_ujian ?? '-' }}</td>
                            <td style="padding:12px 14px; font-size:14px;">
                                <span
                                    style="padding:4px 10px;border-radius:4px;font-size:12px;font-weight:bold;background:#e0e7ff;color:#3730a3; display:inline-block;">
                                    {{ $item->peran_dosen ?? '-' }}
                                </span>
                            </td>
                            <td style="padding:12px 14px; font-size:14px;">{{ $item->tanggal_ujian ?? '-' }}</td>
                            <td style="padding:12px 14px;">
                                @if (optional($item->current_penilaian)->nilai_akhir !== null)
                                    <span
                                        style="padding:4px 10px;border-radius:12px;font-size:12px;font-weight:bold;background:#bbf7d0;color:#166534; display:inline-block;">
                                        Selesai
                                    </span>
                                @else
                                    <span
                                        style="padding:4px 10px;border-radius:12px;font-size:12px;font-weight:bold;background:#fde68a;color:#92400e; display:inline-block;">
                                        Belum Dinilai
                                    </span>
                                @endif
                            </td>
                            <!--
                      jika belum dinilai maka diarahkan ke halaman penilaian
                      jika sudah dinilai maka diarahkan ke halaman detail penilaian-->
                            <td style="padding:12px 14px;">
                                @if (optional($item->current_penilaian)->nilai_akhir !== null)
                                    <a href="{{ route('penilaian.show', $item->current_penilaian->id) }}">
                                        <button
                                            style="padding:6px 12px;
                          background-color:#2563eb;
                          color:#ffffff;
                          border:none;
                          border-radius:4px;
                          cursor:pointer;
                          font-size:12px;
                        ">
                                            Detail Nilai
                                        </button>
                                    </a>
                                @else
                                    <a
                                        href="{{ route('penilaian.create', [
                                            'jenis' => $item->jenis_ujian,
                                            'id' => $item->id,
                                        ]) }}">
                                        <button
                                            style="
                          padding:6px 12px;
                          background-color:#2563eb;
                          color:#ffffff;
                          border:none;
                          border-radius:4px;
                          cursor:pointer;
                          font-size:12px;
                        ">
                                            Nilai
                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
