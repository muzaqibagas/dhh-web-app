@extends('layouts.app')

@section('content')
<h1>Daftar Artikel</h1>
<a href="{{ url('artikel/create') }}">Tambah Artikel</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Aksi</th>
    </tr>
@foreach($artikels as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->judul }}</td>
        <td>
            <a href="{{ url('artikel/' . $item->id) }}">Show</a>
            <a href="{{ url('artikel/' . $item->id . '/edit') }}">Edit</a>
            <form action="{{ url('artikel/' . $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
