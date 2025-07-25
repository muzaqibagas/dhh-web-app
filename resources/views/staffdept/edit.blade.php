@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Staff</h1>    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('staffdept.update', $staffDept->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Kategori --}}
        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select name="id_kategoristaff" id="id_kategoristaff" class="form-select" required>
                @foreach($kategoriStaffs as $kategori)
                    <option value="{{ $kategori->id }}" {{ $staffDept->id_kategori == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Divisi --}}
        <div class="mb-3">
            <label for="id_divisi" class="form-label">Divisi</label>
            <select name="id_divisi" id="id_divisi" class="form-select">
                <option value="">-- Tidak Ada --</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ $staffDept->id_divisi == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label><br>
            @if($staffDept->foto)
                <img src="{{ asset('img/' . $staffDept->foto) }}" alt="Foto" width="100"><br><br>
            @endif
            <input type="file" name="foto" id="foto" class="form-control">
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $staffDept->nama) }}">
        </div>

        {{-- Tanggal Lahir --}}
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $staffDept->tanggal_lahir) }}">
        </div>

        {{-- NIP --}}
        @error('nip')
            <div class="alert alert-danger mt-2 p-2 rounded-2 shadow-sm">
                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $staffDept->nip) }}">
        </div>

        {{-- Jabatan --}}
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $staffDept->jabatan) }}">
        </div>

        {{-- Email --}}
        @error('email')
            <div class="alert alert-danger mt-2 p-2 rounded-2 shadow-sm">
                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $staffDept->email) }}">
        </div>

        {{-- Keahlian --}}
        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian</label>
            <textarea name="keahlian" id="keahlian" class="form-control">{{ old('keahlian', $staffDept->keahlian) }}</textarea>
        </div>

        {{-- Sinta --}}
        <div class="mb-3">
            <label for="sinta" class="form-label">SINTA</label>
            <input type="text" name="sinta" id="sinta" class="form-control" value="{{ old('sinta', $staffDept->sinta) }}">
        </div>

        {{-- Google Scholar --}}
        <div class="mb-3">
            <label for="google_scholar" class="form-label">Google Scholar</label>
            <input type="text" name="google_scholar" id="google_scholar" class="form-control" value="{{ old('google_scholar', $staffDept->google_scholar) }}">
        </div>

        {{-- Scopus --}}
        <div class="mb-3">
            <label for="scopus" class="form-label">Scopus</label>
            <input type="text" name="scopus" id="scopus" class="form-control" value="{{ old('scopus', $staffDept->scopus) }}">
        </div>

        {{-- ResearchGate --}}
        <div class="mb-3">
            <label for="researchgate" class="form-label">ResearchGate</label>
            <input type="text" name="researchgate" id="researchgate" class="form-control" value="{{ old('researchgate', $staffDept->researchgate) }}">
        </div>

        {{-- Website --}}
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $staffDept->website) }}">
        </div>

        {{-- Minat Penelitian --}}
        <div class="mb-3">
            <label for="minat_penelitian" class="form-label">Minat Penelitian</label>
            <textarea name="minat_penelitian" id="minat_penelitian" class="form-control">{{ old('minat_penelitian', $staffDept->minat_penelitian) }}</textarea>
        </div>

        {{-- Riwayat Pendidikan --}}
        <div class="mb-3">
            <label for="riwayat_pendidikan" class="form-label">Riwayat Pendidikan</label>
            <textarea name="riwayat_pendidikan" id="riwayat_pendidikan" class="form-control">{{ old('riwayat_pendidikan', $staffDept->riwayat_pendidikan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('staffdept.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
