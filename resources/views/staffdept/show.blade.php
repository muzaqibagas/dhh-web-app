@extends('layouts.app')

@section('content')
<h1>Detail Staff</h1>

<ul>
    <li>Nama: {{ $staffdept->nama }}</li>
    <li>NIP: {{ $staffdept->nip }}</li>
    <li>Kategori: {{ $staffdept->kategori->nama ?? '-' }}</li>
    <li>Divisi: {{ $staffdept->divisi->nama ?? '-' }}</li>
    <li>Email: {{ $staffdept->email }}</li>
</ul>

<a href="{{ route('staffdept.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
