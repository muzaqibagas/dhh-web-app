@extends('layouts.app')

@section('content')
    <h1>{{ $galeri->judul }}</h1>
    <p>Tanggal: {{ $galeri->tanggal }}</p>
    <p>Tipe: {{ $galeri->tipe }}</p>
    @if($galeri->tipe == 'gambar')
        <p>Gambar: {{ $galeri->gambar }}</p>
    @else
        <p>Video: {{ $galeri->video }}</p>
    @endif
    <p>Deskripsi: {{ $galeri->deskripsi }}</p>
    <p>User ID: {{ $galeri->id_user }}</p>
    <p>Kategori ID: {{ $galeri->id_kategori }}</p>
    <a href="{{ route('galeri.edit', $galeri->id) }}">Edit</a>
@endsection
