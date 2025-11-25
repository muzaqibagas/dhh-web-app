@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>

<!-- ======= Staff Detail Section ======= -->
<section class="staff-det-section">
  <div class="staff-det-container">

    <!-- Foto Staff -->
    <div class="staff-det-photo">
      <img src="{{ asset($staffDept->foto) }}" alt="{{ $staffDept->nama }}">
    </div>

    <!-- Card Informasi Staff -->
    <div class="staff-det-card">
      <h4 class="staff-det-name">{{ $staffDept->nama ?? '-' }}</h4>
      <p class="staff-det-role">{{ $staffDept->jabatan }} | {{ $staffDept->divisi->nama ?? '-' }}</p>


      <div class="staff-det-info">
        <div class="staff-det-row"><span>Tanggal Lahir</span><span>{{ $staffDept->tanggal_lahir ?? '-' }}</span></div>
        <div class="staff-det-row"><span>Email</span><span>{{ $staffDept->email ?? '-' }}</span></div>
        <div class="staff-det-row"><span>Sinta</span><span><a href="{{ $staffDept->sinta }}" target="_blank">{{ $staffDept->sinta ?? '-' }}</a></span></div>
        <div class="staff-det-row"><span>Google Scholar</span><span><a href="{{ $staffDept->google_scholar }}" target="_blank">{{ $staffDept->google_scholar ?? '-' }}</a></span></div>
        <div class="staff-det-row"><span>Scopus</span><span><a href="{{ $staffDept->scopus }}" target="_blank">{{ $staffDept->scopus ?? '-' }}</a></span></div>
        <div class="staff-det-row"><span>Website</span><span><a href="{{ $staffDept->website }}" target="_blank">{{ $staffDept->website ?? '-' }}</a></span></div>
        <div class="staff-det-row"><span>Keahlian</span><span>{{ $staffDept->keahlian ?? '-' }}</span></div>
      </div>

      <!-- Riwayat Pendidikan -->
      <div class="staff-det-section-sub">
        <h5>Riwayat Pendidikan</h5>
        {!! $staffDept->riwayat_pendidikan ?? '-' !!}
      </div>

      <!-- Link Publikasi -->
      <div class="staff-det-section-sub">
        <div class="staff-det-section-sub">
          <h5>Publikasi</h5>
          {!! $staffDept->publikasi ?? '-' !!}
        </div>
      </div>
    </div>

  </div>
</section>

@endsection
