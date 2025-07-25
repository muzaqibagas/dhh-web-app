@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Staff Departemen</h1>

    <div class="card mb-3">
        <div class="row g-0">
            @if($staffDept->foto)
                <div class="col-md-4 text-center p-3">
                    <img src="{{ asset('img/' . $staffDept->foto) }}" class="img-fluid rounded" alt="Foto Staff">
                </div>
            @endif
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $staffDept->nama }}</h4>
                    <p><strong>NIP:</strong> {{ $staffDept->nip }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $staffDept->tanggal_lahir }}</p>
                    <p><strong>Jabatan:</strong> {{ $staffDept->jabatan }}</p>
                    <p><strong>Email:</strong> {{ $staffDept->email }}</p>
                    <p><strong>Divisi:</strong> {{ $staffDept->divisi->nama ?? '-' }}</p>
                    <p><strong>Kategori Staff:</strong> {{ $staffDept->kategoristaff->nama ?? '-' }}</p>
                    <p><strong>Keahlian:</strong> {{ $staffDept->keahlian }}</p>
                    <p><strong>Minat Penelitian:</strong> {{ $staffDept->minat_penelitian }}</p>
                    <p><strong>Riwayat Pendidikan:</strong> {{ $staffDept->riwayat_pendidikan }}</p>
                    <p><strong>Sinta:</strong> <a href="{{ $staffDept->sinta }}" target="_blank">{{ $staffDept->sinta }}</a></p>
                    <p><strong>Google Scholar:</strong> <a href="{{ $staffDept->google_scholar }}" target="_blank">{{ $staffDept->google_scholar }}</a></p>
                    <p><strong>Scopus:</strong> <a href="{{ $staffDept->scopus }}" target="_blank">{{ $staffDept->scopus }}</a></p>
                    <p><strong>ResearchGate:</strong> <a href="{{ $staffDept->researchgate }}" target="_blank">{{ $staffDept->researchgate }}</a></p>
                    <p><strong>Website:</strong> <a href="{{ $staffDept->website }}" target="_blank">{{ $staffDept->website }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('staffdept.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
    <a href="{{ route('staffdept.edit', $staffDept->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('staffdept.destroy', $staffDept->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger">
            Hapus
        </button>
    </form>
</div>
@endsection
