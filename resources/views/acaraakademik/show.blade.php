a@extends('layouts.app')

@section('content')
<h1>Detail Acara Akademik</h1>
<ul>
    <li>ID: {{ $acaraAkademik->id }}</li>
    <li>ID Mahasiswa: {{ $acaraAkademik->id_mahasiswa }}</li>
    <li>ID Staff Dept: {{ $acaraAkademik->id_staffdept }}</li>
    <li>ID Kolokium: {{ $acaraAkademik->id_kolokium }}</li>
    <li>ID Seminar: {{ $acaraAkademik->id_seminar }}</li>
    <li>ID Sidang: {{ $acaraAkademik->id_sidang }}</li>
</ul>
<a href="{{ url('acara-akademik') }}">Kembali</a>
@endsection
