@extends('layouts.app')

@section('content')
<h1>Tambah Jenjang</h1>

<form action="{{ route('jenjang.store') }}" method="POST">
    @csrf
    <label>Nama Jenjang:</label>
    <input type="text" name="nama" required>
    <button type="submit">Simpan</button>
</form>
@endsection
