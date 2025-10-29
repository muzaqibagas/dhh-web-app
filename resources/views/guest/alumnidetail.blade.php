@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="{{ url('/') }}">Home</a> / 
  <a href="{{ url('/alumnikami') }}">Alumni</a> / 
  <span>{{ $alumni->nama }}</span>
</div>

<section class="staff-det-section">
  <div class="staff-det-container">
    <!-- FOTO ALUMNI -->
    <div class="staff-det-photo">
      <img src="{{ asset($alumni->foto ?? 'img/default-alumni.jpg') }}" alt="{{ $alumni->nama }}">
    </div>

    <!-- DETAIL UTAMA -->
    <div class="staff-det-card">
      <h3 class="staff-det-name">{{ $alumni->nama }}</h3>
      <p class="staff-det-role">{{ $alumni->jabatan ?? 'Profesi tidak tersedia' }}</p>
      <p class="text-muted">{{ $alumni->angkatan ? 'DHH angkatan ' . $alumni->angkatan : '' }}</p>

      <div class="staff-det-info mt-3">
        <p style="text-align: justify;">
          {{ $alumni->review ?? 'Review alumni belum tersedia.' }}
        </p>
      </div>
    </div>
  </div>
</section>

<!-- === Alumni Lainnya === -->
<section class="guest-artikel-detail-section container my-5">
  <h4 class="guest-galery-title">Alumni Lainnya</h4>
  <div class="guest-alumni-grid">
    @foreach($alumniLainnya as $lain)
      <div class="guest-alumni-card">
        <img src="{{ asset($lain->foto ?? 'img/default-alumni.jpg') }}" alt="{{ $lain->nama }}">
        <h5>{{ $lain->nama }}</h5>
        <p>{{ Str::limit($lain->review, 100) }}</p>
        <a href="{{ route('guest.alumni.detail', $lain->id) }}" class="btn-see-more">Selengkapnya</a>
      </div>
    @endforeach
  </div>
</section>
@endsection