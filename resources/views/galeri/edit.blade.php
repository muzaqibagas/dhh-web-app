@extends('layouts.app')

@section('content')
    <h1>Edit Galeri</h1>

    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ $galeri->judul }}"><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $galeri->tanggal }}"><br>

        <label for="tipe">Tipe:</label>
        <select name="tipe" id="tipe">
            <option value="gambar" {{ $galeri->tipe == 'gambar' ? 'selected' : '' }}>Gambar</option>
            <option value="video" {{ $galeri->tipe == 'video' ? 'selected' : '' }}>Video</option>
        </select><br>

        <label for="gambar">Gambar (nama file):</label>
        <input type="text" name="gambar" id="gambar" value="{{ $galeri->gambar }}"><br>

        <label for="video">Video (link):</label>
        <input type="text" name="video" id="video" value="{{ $galeri->video }}"><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi">{{ $galeri->deskripsi }}</textarea><br>

        <label for="id_user">User ID:</label>
        <input type="number" name="id_user" id="id_user" value="{{ $galeri->id_user }}"><br>

        <label for="id_kategori">Kategori ID:</label>
        <input type="number" name="id_kategori" id="id_kategori" value="{{ $galeri->id_kategori }}"><br>

        <button type="submit">Update</button>
    </form>
@endsection
