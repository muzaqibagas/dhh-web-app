@extends('layouts.apps')

@section('content')
    <!-- SIDEBAR -->
    <div class="main-container">
        <aside class="sidebar">
            <a href="#" class="menu-image-only">
                <img src="{{ asset('img/logodashboardmhs.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>

            <a href="/dashboardmhs" class="menu">
                <div class="menu-left">
                    <i class="bi bi-house-door-fill"></i> <span> Beranda </span>
                </div>
            </a>
            <a href="/profilemhs" class="menu">
                <div class="menu-left">
                    <i class="bi bi-person"></i> <span> Profil Mahasiswa </span>
                </div>
            </a>
            <a href="/formulirlayananakademikmhs" class="menu active">
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
                <a href="/syaratkomprehensifmhs" class="submenu-link"><i class="bi bi-info-circle"></i> Syarat
                    Komprehensif</a>
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
        <!-- CONTENT -->
        <div class="content">

            <!-- Judul Halaman -->
            <h2 class="page-title">Formulir Layanan Akademik</h2>

            <!-- Card Container -->
            <div class="form-list-container">

                <!-- Satu item formulir -->
                <div class="form-item">
                    <span>Rekomendasi Penelitian</span>
                    <a href="{{ asset('layanan akademik/FRM-IJIN-ATAU-REKOMENDASI-PENELITIAN-S1.pdf') }}"
                        class="btn-download" download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Pembuatan Surat Keterangan Lulus</span>
                    <a href="{{ asset('layanan akademik/FRM-FAHUTAN-21-00-Formulir-Pembuatan-Surat-Keterangan-Lulus.pdf') }}"
                        class="btn-download" download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Distribusi Skripsi-1</span>
                    <a href="{{ asset('layanan akademik/Form-Distribusi-Skripsi-1.pdf') }}" class="btn-download"
                        download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Tanda Terima Proposal Penelitian</span>
                    <a href="{{ asset('layanan akademik/TANDA-TERIMA-PROPOSAL-PENELITIAN.pdf') }}" class="btn-download"
                        download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Pelayanan Akademik</span>
                    <a href="{{ asset('layanan akademik/FRM-FAHUTAN-24-00-Formulir-Pelayanan.pdf') }}" class="btn-download"
                        download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Pembuatan Surat Tunjangan Orang Tua</span>
                    <a href="{{ asset('layanan akademik/FRM-FAHUTAN-22-00-Pembuatan-Surat-Tunjangan-Ortu.pdf') }}"
                        class="btn-download" download>Unduh</a>
                </div>

                <div class="form-item">
                    <span>Surat Izin Sakit</span>
                    <a href="{{ asset('layanan akademik/FORM-SURAT-IJIN-SAKIT-s1.pdf') }}" class="btn-download"
                        download>Unduh</a>
                </div>

            </div> <!-- end form-list-container -->
        </div> <!-- end content -->
    </div> <!-- end main-container -->
@endsection
