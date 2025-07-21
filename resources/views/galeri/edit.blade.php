@extends('layouts.app')

@section('content')
    <h1>Edit Galeri</h1>

    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ $galeri->judul }}"><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $galeri->tanggal }}"><br>

        <label for="tipe">Tipe:</label>
        <select name="tipe" id="tipe" onchange="toggleMediaInput()">
            <option value="gambar" {{ $galeri->tipe == 'gambar' ? 'selected' : '' }}>Gambar</option>
            <option value="video" {{ $galeri->tipe == 'video' ? 'selected' : '' }}>Video</option>
        </select><br>

        <div id="gambar-input">
            <label for="gambar">Upload Gambar Baru:</label>
            <input type="file" name="gambar" id="gambar" accept="image/*"><br>
            <small>Gambar saat ini: {{ $galeri->gambar }}</small><br>
        </div>

        <div id="video-input">
            <label for="video">Video (link):</label>
            <input type="text" name="video" id="video" value="{{ $galeri->video }}"><br>
        </div>

        <label for="id_user">User ID:</label>
        <input type="number" name="id_user" id="id_user" value="{{ $galeri->id_user }}"><br>

        <label for="id_kategori">Kategori:</label>
        <select name="id_kategori" id="id_kategori">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" {{ $galeri->id_kategori == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select><br>

        <button type="submit">Update</button>
        <a href="{{ url('galeri') }}">kembali</a>
    </form>

    <script>
        function toggleMediaInput() {
            const tipe = document.getElementById('tipe').value;
            const gambarInput = document.getElementById('gambar-input');
            const videoInput = document.getElementById('video-input');

            if (tipe === 'gambar') {
                gambarInput.style.display = 'block';
                videoInput.style.display = 'none';
            } else {
                gambarInput.style.display = 'none';
                videoInput.style.display = 'block';
            }
        }

        // Atur visibilitas sesuai data saat halaman dibuka
        document.addEventListener('DOMContentLoaded', toggleMediaInput);
    </script>
@endsection