@extends('layouts.app')

@section('content')
<h1>Daftar Acara Akademik</h1>
<a href="{{ url('acara-akademik/create') }}">Tambah Acara Akademik</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Mahasiswa</th>
        <th>Moderator</th>
        <th>Jenis Acara</th>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Tempat</th>
        <th>Aksi</th>
    </tr>

    @foreach($acaras as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->mahasiswa->name }}</td>
            <td>{{ $item->moderator->nama }}</td>

            @if($item->kolokium)
                <td>Kolokium</td>
                <td>{{ $item->kolokium->judul_kolokium }}</td>
                <td>{{ $item->kolokium->tanggal }}</td>
                <td>{{ $item->kolokium->tempat }}</td>
            @elseif($item->seminar)
                <td>Seminar Hasil</td>
                <td>{{ $item->seminar->judul_seminar }}</td>
                <td>{{ $item->seminar->tanggal }}</td>
                <td>{{ $item->seminar->tempat }}</td>
            @elseif($item->sidang)
                <td>Sidang</td>
                <td>{{ $item->sidang->judul_tugasakhir }}</td>
                <td>{{ $item->sidang->tanggal }}</td>
                <td>{{ $item->sidang->tempat }}</td>
            @else
                <td colspan="4">Belum Ditentukan</td>
            @endif

            <td>
                <a href="{{ route('acara-akademik.show', $item->id) }}">Show</a>
                <a href="{{ route('acara-akademik.edit', $item->id) }}">Edit</a>
                <form action="{{ route('acara-akademik.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>
@endsection