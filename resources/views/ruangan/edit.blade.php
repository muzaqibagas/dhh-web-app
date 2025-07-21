@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Edit Ruangan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Ruangan</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $ruangan->nama }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>
                    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
