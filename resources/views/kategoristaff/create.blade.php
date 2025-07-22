@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Kategori Staff </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kategoriStaff.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kategori Staff</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama ruangan" required>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('kategoriStaff.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
