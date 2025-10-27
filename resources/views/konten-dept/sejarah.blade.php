@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan S1</span>
</div>

    <!-- === Sejarah === -->
    <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
        <h3>Sejarah</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
        <p style="text-align: justify;">
        {{ $kontenDept->sejarah ?? '-' }}
        </p>
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

        <!-- Wrapper Slide -->
        <div class="ketdept-wrapper">
        <div class="ketdept-slide">
            <div class="ketdept-card">
            <img src="{{ asset('img/buistie.jpg') }}" alt="Pimpinan 1">
            <h5>Dr. Andi Saputra</h5>
            <p>Ketua DHH (2000–2005)</p>
            </div>
            <div class="ketdept-card">
            <img src="{{ asset('img/buistie.jpg') }}" alt="Pimpinan 2">
            <h5>Dr. Budi Santoso</h5>
            <p>Ketua DHH (2006–2010)</p>
            </div>
            <div class="ketdept-card">
            <img src="{{ asset('img/buistie.jpg') }}" alt="Pimpinan 3">
            <h5>Prof. Dewi Rahayu</h5>
            <p>Ketua DHH (2011–2016)</p>
            </div>
            <div class="ketdept-card">
            <img src="{{ asset('img/buistie.jpg') }}" alt="Pimpinan 4">
            <h5>Ir. Cahyono</h5>
            <p>Ketua DHH (2017–2021)</p>
            </div>
            <div class="ketdept-card">
            <img src="{{ asset('img/buistie.jpg') }}" alt="Pimpinan 5">
            <h5>Dr. Istie S. Rahayu</h5>
            <p>Ketua DHH (2022–Sekarang)</p>
            </div>
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
        <p style="text-align: justify;">
        {{ $kontenDept->visi ?? '-'}}
        </p>
    </div>
    </section>

    <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
        <h3>Misi</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
        <p style="text-align: justify;">
        {{ $kontenDept->misi ?? '-' }}
        </p>
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
        <p style="text-align: justify;">
        {!! nl2br(e($kontenDept->tujuan ?? '-')) !!}
        </p>
    </div>
    </section>

    <!-- === KEBIJAKAN MUTU === -->
    <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
        <h3>Kebijakan Mutu</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
        <p style="text-align: justify;">
        {!! nl2br(e($kontenDept->kebijakanmutu ?? '-')) !!}
        </p>
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
                    <div class="sej-staff-card">
                        <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                        <h4>{{ $staff->nama }}</h4>
                        <p>{{ $staff->jabatan }}</p>
                    </div>
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
                            @foreach($div->staff as $staff)
                                <div class="sej-staff-card">
                                    <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                                    <h4>{{ $staff->nama }}</h4>
                                    <p>{{ $staff->jabatan }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="sej-kependidikan" class="sej-tab-content">
            <div class="sej-card-grid">
                @forelse($kependidikan as $staff)
                    <div class="sej-staff-card">
                        <img src="{{ asset($staff->foto ?? 'foto_staffdept/default.png') }}" alt="{{ $staff->nama }}">
                        <h4>{{ $staff->nama }}</h4>
                        <p>{{ $staff->jabatan }}</p>
                    </div>
                @empty
                    <p class="text-center">Belum ada data tenaga kependidikan.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>

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
@endsection