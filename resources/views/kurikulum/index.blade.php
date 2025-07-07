@extends('layouts.app')

@section('content')
    <!-- HALAMAN KURIKULUM -->
     <strong>HALAMAN DAFTAR KURIKULUM</strong>
    <h1>Daftar Kurikulum</h1>

    {{-- Form Pencarian --}}
    <form action="{{ route('kurikulum.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari Kurikulum..." value="{{ request('search') }}">
        <button type="submit">Cari</button>    
    </form>

    <a href="{{ route('kurikulum.create') }}">Tambah Data</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Jenjang</th>
                <th>Nama Kurikulum</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td>{{ $item->jenjang->nama ?? '-' }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tahun }}</td>
                <td>
                    <a href="{{ route('kurikulum.edit', $item->id) }}">Edit</a>
                    <form action="{{ route('kurikulum.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
