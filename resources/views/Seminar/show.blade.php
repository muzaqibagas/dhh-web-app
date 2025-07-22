@extends('layouts.app')

@section('content')
    <h1>Detail Seminar</h1>

    <a href="{{ route('seminar.index') }}">← Kembali ke daftar</a>

    <table border="0" cellpadding="8">
        <tr>
            <td><strong>Nama Mahasiswa</strong></td>
            <td>:</td>
            <td>{{ $seminar->mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>:</td>
            <td>{{ $seminar->tanggal }}</td>
        </tr>
        <tr>
            <td><strong>Waktu</strong></td>
            <td>:</td>
            <td>{{ $seminar->waktu }}</td>
        </tr>
        <tr>
            <td><strong>Tempat</strong></td>
            <td>:</td>
            <td>{{ $seminar->ruangan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Judul Seminar</strong></td>
            <td>:</td>
            <td>{{ $seminar->judul_seminar }}</td>
        </tr>
    </table>
@endsection