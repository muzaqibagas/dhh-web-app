@extends('layouts.app')

@section('content')
<h1>Edit Artikel</h1>
<form action="{{ url('artikel/' . $artikel->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Judul:</label>
    <input type="text" name="judul" value="{{ $artikel->judul }}" required>
    <button type="submit">Update</button>
</form>
@endsection
