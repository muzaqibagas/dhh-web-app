@extends('layouts.app')

@section('content')
<h1>Detail Divisi</h1>
<ul>
    <li>ID: {{ $divisi->id }}</li>
    <li>Nama: {{ $divisi->nama }}</li>    
</ul>
<a href="{{ url('divisi.index') }}">Kembali</a>
@endsection
