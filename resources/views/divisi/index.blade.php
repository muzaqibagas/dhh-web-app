@extends('layouts.app')

@section('content')
<h1>Daftar Divisi</h1>
<a href="{{ url('divisi/create') }}">Tambah Divisi</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($divisis as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <a href="{{ url('divisi/' . $item->id) }}">Show</a>
                    <a href="{{ url('divisi/' . $item->id . '/edit') }}">Edit</a>
                    <form action="{{ url('divisi/' . $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-4">Belum ada divisi.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
