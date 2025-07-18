@extends('layouts.app')

@section('content')
<h1>Tambah Artikel</h1>
<form action="{{ url('artikel') }}" method="POST">
    @csrf
    <label>Judul:</label>
    <input type="text" name="judul" required>
    <button type="submit">Simpan</button>
</form>
@endsection
