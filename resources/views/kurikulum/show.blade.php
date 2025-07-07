@extends('layouts.app')

@section('content')
    <h1>Detail Jenjang</h1>

    <p><strong>ID:</strong> {{ $data->id }}</p>
    <p><strong>Nama Jenjang:</strong> {{ $data->nama }}</p>

    <a href="{{ route('jenjang.index') }}">← Kembali ke Daftar</a>
@endsection