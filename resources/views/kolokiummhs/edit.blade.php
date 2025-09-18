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

    <main class="content">
        <div class="kolokium-card">
        <h2 class="page-title">Edit Kolokium</h2>    
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

        <form action="{{ route('kolokiummhs.update', $kolokiummhs->id) }}" method="POST">    
            @csrf
            @method('PUT')   

            <div class="form-group">
            <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $kolokiummhs->nama) }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="id_mahasiswa" value="{{ $kolokiummhs->id_mahasiswa }}">
            </div>

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $kolokiummhs->nim) }}" required>
                @error('nim')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select name="id_semester" required>
                    <option disabled value="">Pilih Semester</option>
                    @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}" 
                        {{ old('id_semester', $kolokiummhs->id_semester) == $semester->id ? 'selected' : '' }}>
                        {{ $semester->semester }}
                    </option>
                    @endforeach
                </select>
                @error('id_semester')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>      

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" 
                    value="{{ old('alamat', $kolokiummhs->alamat) }}" required>
                @error('alamat')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>      

            <div class="form-group">
            <label>Judul Makalah kolokium</label>
            <textarea name="judul_kolokium" placeholder="Masukkan Judul Makalah" required>{{ old('judul_kolokium', $kolokiummhs->judul_kolokium) }}</textarea>
            @error('judul_kolokium')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
            <label>Dosen Pembimbing 1</label>
            <select name="id_pembimbing1" required id="pembimbing1">          
                <option disabled value="">Pilih Dosen</option>
                @foreach ($listDosen as $dosen)
                <option value="{{ $dosen->id }}" 
                    {{ old('id_pembimbing1', $kolokiummhs->id_pembimbing1) == $dosen->id ? 'selected' : '' }}>
                    {{ $dosen->nama }}
                </option>
                @endforeach
            </select>
            @error('id_pembimbing1')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
            <label>Dosen Pembimbing 2</label>
            <select name="id_pembimbing2" id="pembimbing2">                                                       
                <option value="">Pilih Dosen</option> {{-- placeholder tetap ada --}}
                @foreach ($listDosen as $dosen)
                    <option value="{{ $dosen->id }}" 
                        {{ old('id_pembimbing2', $kolokiummhs->id_pembimbing2) == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach                 
            </select>
            @error('id_pembimbing2')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>      

            <div class="form-group">
                <label>Hari/Tanggal kolokium</label>                            
                <div>
                    <input type="date" id="tanggal" name="tanggal" 
                        value="{{ old('tanggal', $kolokiummhs->tanggal) }}" required>
                    <small id="tanggal-error" style="color:red;display:none;">Tanggal Sabtu/Minggu tidak bisa dipilih.</small>
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Waktu Kolokium</label>
                <div>
                    <div class="d-flex align-items-center gap-3">
                        <input type="time" id="waktu_mulai" name="waktu_mulai" min="08:00" max="16:00" value="{{ old('waktu_mulai', $kolokiummhs->waktu_mulai) }}" required>
                        <p class="m-0">S/D</p>
                        <input type="time" id="waktu_selesai" name="waktu_selesai" min="08:00" max="16:00" value="{{ old('waktu_selesai', $kolokiummhs->waktu_selesai) }}" required>
                    </div>
                    <small id="waktu-error" style="color:red;display:none;">Waktu Kolokium tidak boleh pada jam istirahat (12:00 - 13:00).</small>
                    @error('waktu_mulai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('waktu_selesai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="tipe">Tipe Pelaksanaan</label>
                <select id="tipe" name="tipe_pelaksanaan" required>
                    <option value="offline" {{ old('tipe_pelaksanaan', $kolokiummhs->tipe_pelaksanaan) == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="online"  {{ old('tipe_pelaksanaan', $kolokiummhs->tipe_pelaksanaan) == 'online' ? 'selected' : '' }}>Online (Zoom/Meet)</option>
                </select>
                @error('tipe_pelaksanaan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>        

            <div class="form-group" id="ruangan-field">
                <label for="id_ruangan">Ruangan</label>
                <select name="id_ruangan" id="id_ruangan" {{ old('tipe_pelaksanaan', $kolokiummhs->tipe_pelaksanaan) == 'offline' ? 'required' : '' }}>
                    <option value="">Pilih Ruangan</option>
                    @foreach($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}" 
                            {{ old('id_ruangan', $kolokiummhs->id_ruangan) == $ruangan->id ? 'selected' : '' }}>
                            {{ $ruangan->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_ruangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group d-none" id="link-field">
                <label for="link_meeting">Link Meeting</label>          
                <input type="url" name="link_meeting" id="link_meeting" placeholder="https://zoom.us/..." value="{{ old('link_meeting', $kolokiummhs->link_meeting) }}" {{ old('tipe_pelaksanaan', $kolokiummhs->tipe_pelaksanaan) == 'online' ? 'required' : '' }}>
                @error('link_meeting')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>     

            <div class="form-group">
                <label>Dosen Moderator</label>
                <div class="form-static">[Diisi oleh akademik]</div>
            </div>

            <div class="form-actions d-flex justify-content-end">
            <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>
        </div>
    </main>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Pastikan waktu_mulai dan waktu_selesai hanya H:i (tanpa detik) sebelum submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                const waktuMulai = document.getElementById('waktu_mulai');
                const waktuSelesai = document.getElementById('waktu_selesai');
                if (waktuMulai && waktuMulai.value) {
                    waktuMulai.value = waktuMulai.value.substring(0,5);
                }
                if (waktuSelesai && waktuSelesai.value) {
                    waktuSelesai.value = waktuSelesai.value.substring(0,5);
                }
            });
        });
    </script>
    <!-- waktu pendaftaran minimal 4 hari kerja dan sabtu minggu tidak boleh -->
    <script>
        document.getElementById('tanggal').addEventListener('change', function() {
            const val = this.value;
            if (!val) return;
            const date = new Date(val);
            const day = date.getDay();
            // Cek Sabtu/Minggu
            if (day === 0 || day === 6) {
                this.value = '';
                document.getElementById('tanggal-error').textContent = 'Tanggal Sabtu/Minggu tidak bisa dipilih.';
                document.getElementById('tanggal-error').style.display = 'inline';
                return;
            }
            // Hitung minimal 4 hari kerja dari hari ini
            let today = new Date();
            today.setHours(0,0,0,0);
            let workDays = 0;
            let tempDate = new Date(today);
            while (workDays < 4) {
                tempDate.setDate(tempDate.getDate() + 1);
                let tempDay = tempDate.getDay();
                if (tempDay !== 0 && tempDay !== 6) {
                    workDays++;
                }
            }
            // tempDate sekarang adalah minimal tanggal yang boleh dipilih
            if (date < tempDate) {
                this.value = '';
                document.getElementById('tanggal-error').textContent = 'Tanggal harus minimal 4 hari kerja dari hari ini.';
                document.getElementById('tanggal-error').style.display = 'inline';
                return;
            }
            document.getElementById('tanggal-error').style.display = 'none';
        });
    </script>

    <!-- waktu kolokium -->
    <script>
        const waktuMulaiInput = document.getElementById('waktu_mulai');
        const waktuSelesaiInput = document.getElementById('waktu_selesai');
        const waktuError = document.getElementById('waktu-error');

        function validasiJam(input) {
        let val = input.value;
        if (!val) return false;

        if (val < "08:00" || val > "16:00") {
            input.value = "";
            waktuError.style.display = "inline";
            waktuError.textContent = "Jam harus antara 08:00 - 16:00.";
            return false;
        }
        return true;
        }

        waktuMulaiInput.addEventListener("change", function() {
        if (!validasiJam(this)) return;
        
        if (this.value >= "12:00" && this.value < "13:00") {
            this.value = "";
            waktuError.style.display = "inline";
            waktuError.textContent = "Tidak boleh pada jam istirahat (12:00 - 13:00).";
            waktuSelesaiInput.value = "";
            return;
        }
        
        let [jam, menit] = this.value.split(":").map(Number);
        jam++;
        if (jam === 12) jam = 13; // skip istirahat
        if (jam > 17) jam = 17;   // batas maksimal

        let jamStr = jam.toString().padStart(2, "0");
        let menitStr = menit.toString().padStart(2, "0");
        waktuSelesaiInput.value = `${jamStr}:${menitStr}`;
        waktuError.style.display = "none";
        });

        waktuSelesaiInput.addEventListener("change", function() {
        if (!validasiJam(this)) return;

        let mulai = waktuMulaiInput.value;

        if (this.value > "12:00" && this.value <= "13:00") {
            this.value = "";
            waktuError.style.display = "inline";
            waktuError.textContent = "Tidak boleh pada jam istirahat (12:00 - 13:00).";
            return;
        }
        if (mulai && this.value <= mulai) {
            this.value = "";
            waktuError.style.display = "inline";
            waktuError.textContent = "Waktu selesai harus lebih besar dari waktu mulai.";
            return;
        }

        waktuError.style.display = "none";
        });
    </script>

    <!-- dosen Pembimbing -->
    <script>
        $(document).ready(function () {
            // Ambil nilai awal dari server
            let pembimbing1Val = "{{ old('id_pembimbing1', $kolokiummhs->id_pembimbing1) }}";
            let pembimbing2Val = "{{ old('id_pembimbing2', $kolokiummhs->id_pembimbing2) }}";

            // Init Select2
            $('#pembimbing1, #pembimbing2').select2({
                width: '100%',
                placeholder: "Pilih Dosen Pembimbing 2",
                allowClear: true,
            });

            // Simpan opsi awal
            let originalPembimbing2 = $('#pembimbing2 option').clone();

            function filterPembimbing2(selected1) {
                $('#pembimbing2').empty();
                originalPembimbing2.each(function () {
                    if ($(this).val() !== selected1) {
                        $('#pembimbing2').append($(this).clone());
                    }
                });
            }

            // Set nilai awal Pembimbing 1
            if (pembimbing1Val) {
                $('#pembimbing1').val(pembimbing1Val).trigger('change.select2');
                filterPembimbing2(pembimbing1Val);
            }

            // Set nilai awal Pembimbing 2 (hanya kalau ada isinya)
            if (pembimbing2Val) {
                $('#pembimbing2').val(pembimbing2Val).trigger('change.select2');
            } else {
                $('#pembimbing2').val('').trigger('change.select2'); // kosongkan kalau null
            }

            // Event ketika Pembimbing 1 berubah
            $('#pembimbing1').on('change', function () {
                let selected1 = $(this).val();
                filterPembimbing2(selected1);
                $('#pembimbing2').val('').trigger('change.select2'); // reset jadi kosong
            });
        });
    </script>

    <!-- ruangan -->
    <script>
        const tipe = document.getElementById('tipe');
        const ruanganField = document.getElementById('ruangan-field');
        const linkField = document.getElementById('link-field');
        const idRuangan = document.getElementById('id_ruangan');
        const linkMeeting = document.getElementById('link_meeting');

        function toggleTipe() {
            if (tipe.value === 'online') {
                ruanganField.classList.add('d-none');
                linkField.classList.remove('d-none');
                idRuangan.removeAttribute('required');
                idRuangan.value = ''; // <-- ini penting!
                linkMeeting.setAttribute('required', 'required');
            } else {
                ruanganField.classList.remove('d-none');
                linkField.classList.add('d-none');
                idRuangan.setAttribute('required', 'required');
                linkMeeting.removeAttribute('required');
            }
        }

        // jalankan saat pertama kali load
        toggleTipe();

        // jalankan saat ada perubahan select
        tipe.addEventListener('change', toggleTipe);
    </script>

    <!-- <script>
        document.getElementById('waktu_mulai').addEventListener('change', function() {
            let mulai = this.value;
            let selesaiSelect = document.getElementById('waktu_selesai');

            // Ambil semua opsi selesai
            let semuaOpsi = selesaiSelect.querySelectorAll('option');

            semuaOpsi.forEach(opt => {
                if (!opt.value) return; // skip placeholder
                let diff = (parseInt(opt.value.split(':')[0]) * 60 + parseInt(opt.value.split(':')[1])) -
                            (parseInt(mulai.split(':')[0]) * 60 + parseInt(mulai.split(':')[1]));
                
                // Kalau selisihnya < 120 menit (2 jam), sembunyikan
                opt.style.display = diff >= 60 ? '' : 'none';
            });

            // Reset pilihan selesai
            selesaiSelect.value = '';
        });
    </script> -->

@endpush

@endsection

</body>
