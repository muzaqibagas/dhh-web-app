@extends('layouts.app')

@section('content')
    <h1>Daftar Kolokium</h1>

    <a href="{{ url('kolokium/create') }}">Tambah Kolokium</a>
    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>                                  
            <th>Tempat</th>
            <th>judul kolokium</th>
            <th>Aksi</th>
        </tr>
        @foreach($kolokiums as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>                        
                <td>{{ $item->ruangan->nama ?? '-' }}</td>
                <td>{{ $item->judul_kolokium }}</td>
                
                <td>
                    <a href="{{ url('kolokium/' . $item->id) }}">Show</a>
                    <a href="{{ url('kolokium/' . $item->id . '/edit') }}">Edit</a>
                    <form action="{{ url('kolokium/' . $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus daftar kolokium ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
