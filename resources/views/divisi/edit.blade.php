@extends('layouts.app')

@section('content')
<strong>haloo nanuyy</strong>
<h1>Edit Divisi</h1>
<form action="{{ url('divisi/' . $divisi->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama:</label>
    <input type="text" name="nama" value="{{ $divisi->nama }}" required>
    <button type="submit">Update</button>
</form>
@endsection
