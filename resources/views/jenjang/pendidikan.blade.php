@extends('layouts.app')

@section('content')

<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan {{ $jenjang }}</span>
</div>

@if(!$data)
  <section class="pend-section text-center py-5">
    <h3>Konten untuk {{ $jenjang }} belum tersedia.</h3>
  </section>
@else
  <!-- === Profil Program Studi === -->
  <section class="pend-section">
    <div class="pend-container" data-aos="fade-up">
      <div class="pend-text">
        <h3>Profil Program Studi {{ $jenjang }}</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        <p>{!! nl2br(e($data->profil)) !!}</p>
      </div>
      <div class="pend-image">
        <img src="{{ asset($data->foto ?? 'img/default.png') }}" alt="Mahasiswa {{ $jenjang }}">
      </div>
    </div>
  </section>

  <!-- === Visi dan Misi === -->
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Visi</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify; margin-bottom:10px !important">{!! nl2br(e($data->visi)) !!}</p>

    <div class="pend-text mt-5">
      <h3>Misi</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify; margin-bottom:10px !important">{!! nl2br(e($data->misi)) !!}</p>

    <div class="pend-text mt-5">
      <h3>Kompetensi Lulusan</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify; margin-bottom:10px !important">{!! nl2br(e($data->kompetensilulusan)) !!}</p>

    <div class="pend-text mt-5">
      <h3>Capaian Pembelajaran</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify; margin-bottom:10px !important">{!! nl2br(e($data->capaianpembelajaran)) !!}</p>
    @if($data->leaflets && $data->leaflets->count() > 0)
    <div class="pend-leaflet row mt-4">
      @foreach($data->leaflets as $leaflet)
        <div class="col-md-6 mb-3">
          <img src="{{ asset($leaflet->gambar) }}" class="img-fluid rounded shadow-sm" alt="Leaflet">
        </div>
      @endforeach
    </div>
    @endif

    <div class="pend-text mt-5">
      <h3>Kurikulum dan Mata Kuliah</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify; margin-bottom:10px !important">
      Silakan kunjungi laman 
      <a href="https://panduan.ipb.ac.id" target="_blank">panduan.ipb.ac.id</a>
      untuk melihat informasi lengkap mengenai mata kuliah dan kurikulum.
    </p>

    <div class="pend-text mt-5">
      <h3>Akreditasi</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <div class="text-center">
      @if($data->sertifikatakreditasi)
        <img src="{{ asset($data->sertifikatakreditasi) }}" alt="Sertifikat" class="img-fluid rounded shadow-sm my-3" style="max-width: 400px;">
      @endif
      <p style="text-align: justify; margin-bottom:10px !important">{!! nl2br(e($data->deskripsiakreditasi)) !!}</p>
    </div>
  </section>
@endif

@endsection
