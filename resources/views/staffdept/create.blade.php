@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Staff Departemen</h1>

    <form action="{{ route('staffdept.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" id="foto">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" id="jabatan">
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="mb-3">
            <label for="id_divisi" class="form-label">Divisi</label>
            <select name="id_divisi" id="id_divisi" class="form-select">
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisis as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriStaffs as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian</label>
            <textarea name="keahlian" class="form-control" id="keahlian"></textarea>
        </div>

        <div class="mb-3">
            <label for="minat_penelitian" class="form-label">Minat Penelitian</label>
            <textarea name="minat_penelitian" class="form-control" id="minat_penelitian"></textarea>
        </div>

        <div class="mb-3">
            <label for="riwayat_pendidikan" class="form-label">Riwayat Pendidikan</label>
            <textarea name="riwayat_pendidikan" class="form-control" id="riwayat_pendidikan"></textarea>
        </div>

        <div class="mb-3">
            <label for="sinta" class="form-label">SINTA</label>
            <input type="text" name="sinta" class="form-control" id="sinta">
        </div>

        <div class="mb-3">
            <label for="google_scholar" class="form-label">Google Scholar</label>
            <input type="text" name="google_scholar" class="form-control" id="google_scholar">
        </div>

        <div class="mb-3">
            <label for="scopus" class="form-label">Scopus</label>
            <input type="text" name="scopus" class="form-control" id="scopus">
        </div>

        <div class="mb-3">
            <label for="researchgate" class="form-label">ResearchGate</label>
            <input type="text" name="researchgate" class="form-control" id="researchgate">
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" name="website" class="form-control" id="website">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('staffdept.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
