@extends('layouts.app')

@section('content')
    <h1>Daftar Seminar</h1>

    <a href="{{ url('seminar/create') }}">Tambah Seminar</a>
    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>                                  
            <th>Tempat</th>
            <th>judul Seminar</th>
            <th>Aksi</th>
        </tr>
        @foreach($seminars as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>                        
                <td>{{ $item->ruangan->nama ?? '-' }}</td>
                <td>{{ $item->judul_seminar }}</td>
                
                <td>
                    <a href="{{ url('seminar/' . $item->id) }}">Show</a>
                    <a href="{{ url('seminar/' . $item->id . '/edit') }}">Edit</a>
                    <form action="{{ url('seminar/' . $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus daftar seminar ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection