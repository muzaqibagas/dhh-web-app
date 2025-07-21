@extends('layouts.app')

@section('content')
    <h1>Detail Sidang</h1>

    <a href="{{ route('sidang.index') }}">← Kembali ke daftar</a>

    <table border="0" cellpadding="8">
        <tr>
            <td><strong>Nama Mahasiswa</strong></td>
            <td>:</td>
            <td>{{ $sidang->mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>:</td>
            <td>{{ $sidang->tanggal }}</td>
        </tr>
        <tr>
            <td><strong>Waktu</strong></td>
            <td>:</td>
            <td>{{ $sidang->waktu }}</td>
        </tr>
        <tr>
            <td><strong>Tempat</strong></td>
            <td>:</td>
            <td>{{ $sidang->ruangan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Judul Sidang</strong></td>
            <td>:</td>
            <td>{{ $sidang->judul_tugasakhir }}</td>
        </tr>
    </table>
@endsection
