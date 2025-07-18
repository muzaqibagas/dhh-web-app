@extends('layouts.app')

@section('content')
<h1>Edit Acara Akademik</h1>
<form action="{{ url('acara-akademik/' . $acaraakademik->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama:</label>
    <input type="text" name="nama" value="{{ $acaraakademik->nama }}" required>
    <button type="submit">Update</button>
</form>
@endsection
