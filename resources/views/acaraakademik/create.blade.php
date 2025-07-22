@extends('layouts.app')

@section('content')
<h1>Tambah Acara Akademik</h1>
<form action="{{ url('acara-akademik') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="nama" required>
    <button type="submit">Simpan</button>
</form>
@endsection
