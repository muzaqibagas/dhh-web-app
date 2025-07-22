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
        <select name="tipe" id="tipe" onchange="toggleMediaInput()">        
            <option value="gambar">Gambar</option>
            <option value="video">Video</option>
        </select><br>

        <div id="gambar-input">
            <label for="gambar">Gambar (nama file):</label>
            <input type="file" name="gambar" id="gambar"><br>
        </div>

        <div id="video-input" style="display: none;">
            <label for="video">Video (link):</label>
            <input type="text" name="video" id="video"><br>        
        </div>

        <label for="id_user">User ID:</label>
        <input type="number" name="id_user" id="id_user"><br>

        <label for="id_kategori">Kategori:</label>
        <select name="id_kategori" id="id_kategori">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
            @endforeach
        </select><br>


        <button type="submit">Simpan</button>
    </form>

    <script>
        function toggleMediaInput() {
            const tipe = document.getElementById('tipe').value;
            const gambarInput = document.getElementById('gambar-input');
            const videoInput = document.getElementById('video-input');

            if (tipe === 'gambar') {
                gambarInput.style.display = 'block';
                videoInput.style.display = 'none';
            } else if (tipe === 'video') {
                gambarInput.style.display = 'none';
                videoInput.style.display = 'block';
            }
        }

        // Jalankan sekali saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', toggleMediaInput);
    </script>
@endsection
