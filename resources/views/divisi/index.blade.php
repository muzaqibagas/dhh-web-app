@extends('layouts.app')

@section('content')
<h1>Daftar Divisi</h1>
<a href="{{ url('divisi/create') }}">Tambah Divisi</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    @foreach($divisis as $item)
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
    @endforeach
</table>
@endsection
