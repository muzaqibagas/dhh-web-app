@extends('layouts.app')

@section('content')
<h1>Daftar Acara Akademik</h1>
<a href="{{ url('acara-akademik/create') }}">Tambah Acara Akademik</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    @foreach($acaras as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->nama }}</td>
        <td>
            <a href="{{ url('acara-akademik/' . $item->id) }}">Show</a>
            <a href="{{ url('acara-akademik/' . $item->id . '/edit') }}">Edit</a>
            <form action="{{ url('acara-akademik/' . $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
