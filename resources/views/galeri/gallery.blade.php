@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Galeri</span>
</div>

<section class="guest-galery-section">
  <!-- Video terbaru -->
  <div class="guest-galery-video">
    @if($videoTerbaru)      
      <iframe width="100%" height="500" src="{{ $videoTerbaru->video }}" title="{{ $videoTerbaru->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    @else
        <p class="text-center">Belum ada video.</p>
    @endif
  </div>

  <!-- Video Lainnya random -->
  <h3 class="guest-pend-section-title">Video Lainnya</h3>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <div class="guest-galery-videos">
    @foreach ($videoLainnya as $video)
      <div class="guest-galery-video-card">
          <iframe width="100%" height="200"
          src="{{ $video->video }}"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
          </iframe>
      </div>
    @endforeach    
  </div>

  <!-- Gallery -->
  <h2 class="guest-galery-title">Gallery</h2>
  <p class="guest-galery-desc">
    Sebagaimana hutan menyimpan jejak kehidupan, galeri ini menyimpan jejak langkah kami dalam berkegiatan, belajar, dan tumbuh bersama.
  </p>

  <ul class="guest-galery-filters">
      {{-- Semua --}}      
      <li class="guest-galery-filter {{ !isset($kategoriAktif) ? 'active' : '' }}" data-filter="all">
          <a href="{{ route('galeri.gallery') }}" class="text-decoration-none text-light fw-bold">
              Semua {{ $semuaFoto->count() }}
          </a>
      </li>

      {{-- Kategori --}}
      @foreach($kategoriGaleri as $kategori)
          <li class="guest-galery-filter {{ (isset($kategoriAktif) && $kategoriAktif == $kategori->id) ? 'active' : '' }}" data-filter="{{ $kategori->id }}">
              <a href="{{ route('galeri.kategori', $kategori->id) }}" class="text-decoration-none text-light fw-bold">
                  {{ $kategori->nama }}
                  {{ $semuaFoto->where('id_kategorigaleri', $kategori->id)->count() }}
              </a>
          </li>
      @endforeach
  </ul>


  <!-- Grid Foto -->  
  <div class="guest-galery-grid guest-galery-grid-5">
    @foreach ($galeriFoto as $foto)
        @if ($foto->tipe == 'gambar')
            <div class="guest-galery-item" data-category="{{ $foto->id_kategorigaleri }}">        
                <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}">                 
                <span class="gallery-caption">{{ $foto->judul }}</span>
            </div>
        @endif
    @endforeach 
  </div>

  <!-- Pagination -->
  <div class="guest-galery-pagination d-flex align-items-center justify-content-center mt-4">    
    {{-- Tombol Previous --}}
    @if ($galeriFoto->onFirstPage())
      <button class="guest-galery-prev disabled">&lt;</button>
    @else
      <a href="{{ $galeriFoto->previousPageUrl() }}" class="guest-galery-prev">&lt;</a>
    @endif

    {{-- Nomor Halaman --}}
    <div class="guest-galery-pages d-flex">
      @foreach ($galeriFoto->getUrlRange(1, $galeriFoto->lastPage()) as $page => $url)                      
        <a href="{{ $url }}" class="guest-galery-page {{ $page == $galeriFoto->currentPage() ? 'active' : '' }}" style="background-color: {{ $page == $galeriFoto->currentPage() ? '#FFD700' : '#eaeaea' }}; color: {{ $page == $galeriFoto->currentPage() ? '#fff' : '#333' }}; padding: 6px 12px; border-radius: 6px; margin: 0 4px; font-weight: 600; text-decoration: none; transition: 0.2s;">{{ $page }}</a>
      @endforeach
    </div>

    {{-- Tombol Next --}}
    @if ($galeriFoto->hasMorePages())
      <a href="{{ $galeriFoto->nextPageUrl() }}" class="guest-galery-next">&gt;</a>
    @else
      <button class="guest-galery-next disabled">&gt;</button>
    @endif
  </div>
</section>

@push('script')
  <script>
    const filters = document.querySelectorAll(".guest-galery-filter");
    const items = document.querySelectorAll(".guest-galery-item");
    const grid = document.querySelector(".guest-galery-grid");

    filters.forEach(filter => {
      filter.addEventListener("click", () => {
        filters.forEach(f => f.classList.remove("active"));
        filter.classList.add("active");

        const category = filter.dataset.filter;

        // ubah layout grid
        if (category === "all") {
          grid.classList.remove("guest-galery-grid-3");
          grid.classList.add("guest-galery-grid-5");
        } else {
          grid.classList.remove("guest-galery-grid-5");
          grid.classList.add("guest-galery-grid-3");
        }

        // filter item
        items.forEach(item => {
          if (category === "all" || item.dataset.category === category) {
            item.classList.remove("hidden");
          } else {
            item.classList.add("hidden");
          }
        });
      });
    });

  </script>  
@endpush
@endsection