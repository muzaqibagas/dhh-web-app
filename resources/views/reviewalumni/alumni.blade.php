@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Alumnikami</span>
</div>
<div class="guest-carousel-alumni-container">
    <!-- SLIDES -->
    <div class="guest-carousel-alumni-slide guest-active">
        <img src="img/alumnikita.png" alt="alumni">
        <div class="guest-carousel-alumni-caption">
            <h2>Alumni Berprestasi</h2>
            <p>Para alumni Departemen Hasil Hutan berkiprah di berbagai bidang industri dan akademik.</p>
        </div>
    </div>       
</div>
<section class="guest-artikel-detail-section container my-5">
  <div class="row">
<!-- Gallery -->
  <h2 class="guest-galery-title">Alumni Kami</h2>
  <p class="guest-galery-desc">
    Profil alumni ini menjadi pengingat bahwa keberhasilan hadir dalam banyak bentuk, dengan satu semangat yang sama: berkembang dan memberi makna.
  </p>

  <div class="guest-alumni-grid">
      @foreach ($reviews as $review)
          <a href="{{ route('review-alumni.show', $review->id) }}" class="guest-alumni-card text-decoration-none">
              <img src="{{ asset($review->foto) }}" alt="{{ $review->nama }}">
              <h5>{{ $review->nama }}</h5>
              <p>{{ Str::limit($review->review, 120) }}</p>
          </a>
      @endforeach
  </div>  

  {{-- Pagination --}}
  <div class="guest-galery-pagination d-flex align-items-center justify-content-center mt-4">  
      {{-- Tombol Previous --}}
      @if ($reviews->onFirstPage())
          <button class="guest-galery-prev disabled">&lt;</button>
      @else
          <a href="{{ $reviews->previousPageUrl() }}" class="guest-galery-prev">&lt;</a>
      @endif

      {{-- Nomor Halaman --}}
      <div class="guest-galery-pages d-flex">
          @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)                      
              <a href="{{ $url }}" class="guest-galery-page {{ $page == $reviews->currentPage() ? 'active' : '' }}" style="background-color: {{ $page == $reviews->currentPage() ? '#FFD700' : '#eaeaea' }}; color: {{ $page == $reviews->currentPage() ? '#fff' : '#333' }}; padding: 6px 12px; border-radius: 6px; margin: 0 4px; font-weight: 600; text-decoration: none; transition: 0.2s;">{{ $page }}</a>
          @endforeach
      </div>

      {{-- Tombol Next --}}
      @if ($reviews->hasMorePages())
          <a href="{{ $reviews->nextPageUrl() }}" class="guest-galery-next">&gt;</a>
      @else
          <button class="guest-galery-next disabled">&gt;</button>
      @endif
  </div>

</section>
@endsection
