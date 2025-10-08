@extends('layouts.app')

@section('content')
<h1>Daftar Jenjang</h1>

<form action="{{ route('jenjang.index') }}" method="GET">
    <input type="text" name="search" placeholder="Cari jenjang..." value="{{ request('search') }}">
    <button type="submit">Cari</button>    
</form>
<a href="{{ route('jenjang.create') }}">Tambah Data</a>
@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <a href="{{ route('jenjang.show', $item->id) }}">Show</a>
                    <a href="{{ route('jenjang.edit', $item->id) }}">Edit</a>
                    <form action="{{ route('jenjang.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-4">Belum ada jenjang.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
