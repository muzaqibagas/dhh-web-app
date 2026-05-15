@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumb ======= -->
    <div class="guest-breadcrumb py-2 px-3">
        <a href="#">Home</a> / <span>Alumni / Detail Alumni</span>
    </div>

    <!-- === DETAIL ALUMNI === -->
    <section class="staff-det-section mb-5s">
        <div class="staff-det-container">
            <!-- FOTO ALUMNI -->
            <div class="staff-det-photo">
                <img src="{{ asset($reviewAlumni->foto) }}" alt="Foto Alumni">
            </div>

            <!-- DETAIL ALUMNI -->
            <div class="staff-det-card">
                <h3 class="staff-det-name">{{ $reviewAlumni->nama }}</h3>
                <p class="staff-det-role">{{ $reviewAlumni->profesi }}</p>
                <p class="text-muted">Departemen Hasil Hutan Angkatan {{ $reviewAlumni->angkatan }}</p>

                <div class="staff-det-info mt-3">
                    <p style="text-align: justify;">
                        @php
                            $text = $reviewAlumni->review ?? '-';
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
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- === ALUMNI LAINNYA === -->

    <div class="judul-tengah">
        <h3 class="judul-tengah-title">Alumni Lainnya</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider" class="judul-tengah-divider">
    </div>

    <section class="guest-artikel-detail-section container my-5">

        <div class="guest-alumni-grid">
            @foreach ($randomReviews as $review)
                <div class="guest-alumni-card">
                    <img src="{{ asset($review->foto) }}" alt="{{ $review->nama }}">
                    <h5>{{ $review->nama }}</h5>
                    <p>{{ Str::limit($review->review, 120) }}</p>
                    <a href="{{ route('review-alumni.show', $review->id) }}" class="btn-see-more">Selengkapnya</a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
