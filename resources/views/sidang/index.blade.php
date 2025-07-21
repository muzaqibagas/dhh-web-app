@extends('layouts.app')

@section('content')
    <h1>Daftar Sidang</h1>

    <a href="{{ url('sidang/create') }}">Tambah Sidang</a>
    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>                                  
            <th>Tempat</th>
            <th>judul Sidang</th>
            <th>Aksi</th>
        </tr>
        @foreach($sidangs as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>                        
                <td>{{ $item->ruangan->nama ?? '-' }}</td>
                <td>{{ $item->judul_tugasakhir }}</td>
                
                <td>
                    <a href="{{ url('sidang/' . $item->id) }}">Show</a>
                    <a href="{{ url('sidang/' . $item->id . '/edit') }}">Edit</a>
                    <form action="{{ url('sidang/' . $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus daftar kolokium ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
