@extends('layouts.app')

@section('content')
    <h1>Detail Kolokium</h1>

    <a href="{{ route('kolokium.index') }}">← Kembali ke daftar</a>

    <table border="0" cellpadding="8">
        <tr>
            <td><strong>Nama Mahasiswa</strong></td>
            <td>:</td>
            <td>{{ $kolokium->mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>:</td>
            <td>{{ $kolokium->tanggal }}</td>
        </tr>
        <tr>
            <td><strong>Waktu</strong></td>
            <td>:</td>
            <td>{{ $kolokium->waktu }}</td>
        </tr>
        <tr>
            <td><strong>Tempat</strong></td>
            <td>:</td>
            <td>{{ $kolokium->ruangan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Judul Kolokium</strong></td>
            <td>:</td>
            <td>{{ $kolokium->judul_kolokium }}</td>
        </tr>
    </table>
@endsection
