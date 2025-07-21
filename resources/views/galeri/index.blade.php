@extends('layouts.app')

@section('content')
<h1>Daftar Galeri</h1>
<a href="{{ url('galeri/create') }}">Tambah Galeri</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    @foreach($galeris as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->judul }}</td>
        <td>
            <a href="{{ url('galeri/' . $item->id) }}">Show</a>
            <a href="{{ url('galeri/' . $item->id . '/edit') }}">Edit</a>
            <form action="{{ url('galeri/' . $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection