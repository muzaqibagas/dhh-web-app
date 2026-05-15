@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Kategori Staff</h5>
                <a href="{{ route('kategoristaff.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $kategoriStaff->id }}</dd>

                    <dt class="col-sm-3">Nama Kategori Staff</dt>
                    <dd class="col-sm-9">{{ $kategoriStaff->nama }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
