@extends('layouts.app')

@section('content')
    <h1>Tambah Galeri</h1>

    <form action="{{ route('galeri.store') }}" method="POST">
        @csrf

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul"><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal"><br>

        <label for="tipe">Tipe:</label>
        <select name="tipe" id="tipe">
            <option value="gambar">Gambar</option>
            <option value="video">Video</option>
        </select><br>

        <label for="gambar">Gambar (nama file):</label>
        <input type="text" name="gambar" id="gambar"><br>

        <label for="video">Video (link):</label>
        <input type="text" name="video" id="video"><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"></textarea><br>

        <label for="id_user">User ID:</label>
        <input type="number" name="id_user" id="id_user"><br>

        <label for="id_kategori">Kategori ID:</label>
        <input type="number" name="id_kategori" id="id_kategori"><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
