@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>

    <!-- === Sejarah === -->
    <section class="pend-section mt-5" data-aos="fade-up">
        <div class="pend-text">
            <h3>Sejarah</h3>
            <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        </div>        
        @php
            $text = $kontenDept->sejarah ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
    </section>

    <!-- ====== SECTION PIMPINAN DARI DULU HINGGA SEKARANG ====== -->
    <section class="ketdept-section py-5">
        <div class="container position-relative">

            <!-- Panah kiri -->
            <button class="ketdept-prev">
            <i class="bi bi-chevron-left"></i>
            </button>

            <!-- Panah kanan -->
            <button class="ketdept-next">
            <i class="bi bi-chevron-right"></i>
            </button>
            
            <div class="ketdept-wrapper">
                <div class="ketdept-slide">
                    @foreach ($ketuadhh as $ketua)
                        <div class="ketdept-card">
                            <img src="{{ asset($ketua->foto) }}" alt="{{ $ketua->nama }}">
                            <h5>{{ $ketua->nama }}</h5>
                            <p>Ketua DHH ({{ $ketua->tahun_mulai }}–{{ $ketua->tahun_selesai }})</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slide = document.querySelector(".ketdept-slide");
            const cards = document.querySelectorAll(".ketdept-card");
            const nextBtn = document.querySelector(".ketdept-next");
            const prevBtn = document.querySelector(".ketdept-prev");

            let index = 0;
            slide.innerHTML += slide.innerHTML; // efek loop
            const totalCards = slide.querySelectorAll(".ketdept-card");
            const cardCount = cards.length;

            function updateSlide() {
                const cardWidth = totalCards[0].offsetWidth + 32; // +gap
                slide.style.transform = `translateX(-${index * cardWidth}px)`;
            }

            nextBtn.addEventListener("click", () => {
                index++;
                updateSlide();
                if (index >= cardCount) {
                setTimeout(() => {
                    slide.style.transition = "none";
                    index = 0;
                    updateSlide();
                    void slide.offsetWidth;
                    slide.style.transition = "transform 0.4s ease-in-out";
                }, 400);
                }
            });

            prevBtn.addEventListener("click", () => {
                index--;
                if (index < 0) {
                slide.style.transition = "none";
                index = cardCount - 1;
                updateSlide();
                void slide.offsetWidth;
                slide.style.transition = "transform 0.4s ease-in-out";
                }
                updateSlide();
            });

            window.addEventListener("resize", updateSlide);
        });
    </script>

    <!-- === Visi & Misi === -->
    <section class="pend-section" data-aos="fade-up">
        <div class="pend-text">
            <h3>Visi</h3>
            <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        </div>        
        @php
            $text = $kontenDept->visi ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
    </section>

    <section class="pend-section" data-aos="fade-up">
        <div class="pend-text">
            <h3>Misi</h3>
            <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        </div>    
        @php
            $text = $kontenDept->misi ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
    </section>

    <script>
        AOS.init({
        duration: 1000,
        once: true
        });
    </script>

    <!-- === TUJUAN === -->    
    <section class="pend-section" data-aos="fade-up">
        <div class="pend-text">
            <h3>Tujuan</h3>
            <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        </div>
        @php
            $text = $kontenDept->tujuan ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
    </section>

    <!-- === KEBIJAKAN MUTU === -->
    <section class="pend-section" data-aos="fade-up">
        <div class="pend-text">
            <h3>Kebijakan Mutu</h3>
            <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        </div>        
        @php
            $text = $kontenDept->kebijakanmutu ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
    </section>

    <div class="judul-tengah">
        <h3 class="judul-tengah-title">Staff Departemen</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider" class="judul-tengah-divider">
    </div>
    <!-- Tabs -->
    <div class="sej-tabs">
        <button class="sej-tab-button active" data-tab="sej-struktur">Struktur Organisasi</button>
        <button class="sej-tab-button" data-tab="sej-dosen">Tenaga Pendidik/Dosen</button>
        <button class="sej-tab-button" data-tab="sej-kependidikan">Tenaga Kependidikan</button>
    </div>
    <!-- Tab Contents -->
    <section>
        <div id="sej-struktur" class="sej-tab-content active">
            <div class="sej-card-grid">
                @forelse ($struktur as $staff)
                    <a href="{{ route('staffdept.show', $staff->id) }}" class="sej-staff-card" style="text-decoration:none; color:inherit;">
                        <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                        <h4>{{ $staff->nama }}</h4>
                        <p>{{ $staff->jabatan }}</p>
                    </a>
                @empty
                    <p class="text-center">Belum ada data struktur organisasi.</p>
                @endforelse
            </div>
        </div>
        
        <div id="sej-dosen" class="sej-tab-content">
            @foreach($divisiList as $div)
                @if($div->staff->count() > 0)
                    <div class="sej-division">
                        <h3 class="sej-division-title">Divisi {{ $div->nama }}</h3>
                        <div class="sej-card-grid">
                            @forelse($div->staff as $staff)
                            
                                <a href="{{ route('staffdept.show', $staff->id) }}" class="sej-staff-card" style="text-decoration:none; color:inherit;">
                                    <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                                    <h4>{{ $staff->nama }}</h4>
                                    <p>{{ $staff->jabatan }}</p>
                                </a>
                            @empty
                                <p class="text-center">Belum ada data struktur organisasi.</p>
                            @endforelse
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="sej-kependidikan" class="sej-tab-content">
            <div class="sej-card-grid">
                @forelse($kependidikan as $staff)
                    <a href="{{ route('staffdept.show', $staff->id) }}" class="sej-staff-card" style="text-decoration:none; color:inherit;">
                        <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                        <h4>{{ $staff->nama }}</h4>
                        <p>{{ $staff->jabatan }}</p>
                    </a>
                @empty
                    <p class="text-center">Belum ada data struktur organisasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <script>
        const buttons = document.querySelectorAll('.sej-tab-button');
        const contents = document.querySelectorAll('.sej-tab-content');

        buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            btn.classList.add('active');
            document.getElementById(btn.dataset.tab).classList.add('active');
        });
        });
    </script>  

@push('style')
<style>
    .pend-section {
        padding: 0 8% !important;
        margin-bottom: 40px;        
    }
</style>
@endpush
@endsection