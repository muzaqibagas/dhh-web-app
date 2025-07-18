@extends('layouts.app')

@section('content')
<h1>Tambah Divisi</h1>
<form action="{{ url('divisi') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="nama" required>
    <button type="submit">Simpan</button>
</form>
@endsection
