@extends('layouts.app')

@section('content')
<h1>Tambah Kolokium</h1>

<form action="{{ route('kolokium.store') }}" method="POST">
    @csrf
    <label for="id_mahasiswa">Nama Mahasiswa:</label>
    <select name="id_mahasiswa" id="id_mahasiswa" required>
        <option value="">-- Pilih Mahasiswa --</option>
        @foreach ($mahasiswas as $mahasiswa)
            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama }}</option>
        @endforeach
    </select><br><br>

    
    <label for="id_ruangan">Ruangan:</label>
    <select name="id_ruangan" id="id_ruangan" required>
        <option value="">-- Pilih Ruangan --</option>
        @foreach ($ruangans as $ruangan)
            <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
        @endforeach
    </select><br><br>

    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" id="tanggal" required><br><br>

    <label for="waktu">Waktu:</label>
    <input type="time" name="waktu" id="waktu" required><br><br>

    <label for="judul_kolokium">Judul Kolokium:</label>
    <input type="text" name="judul_kolokium" id="judul_kolokium" required><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection