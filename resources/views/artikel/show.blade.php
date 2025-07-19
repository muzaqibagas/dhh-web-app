@extends('layouts.app')

@section('content')
<h1>Detail Artikel</h1>
<ul>
    <li>ID: {{ $artikel->id }}</li>
    <li>Judul: {{ $artikel->judul }}</li>
    <li>Foto: {{ $artikel->foto }}</li>
    <li>Tanggal: {{ $artikel->tanggal }}</li>
    <li>Deskripsi: {{ $artikel->deskripsi }}</li>
    <li>User: {{ $artikel->id_user }}</li>
    <li>Kategori: {{ $artikel->id_kategori }}</li>
</ul>
<a href="{{ url('artikel') }}">Kembali</a>
@endsection
