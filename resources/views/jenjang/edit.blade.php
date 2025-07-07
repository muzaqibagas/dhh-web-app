@extends('layouts.app')

@section('content')
<h1>Edit Jenjang</h1>

<form action="{{ route('jenjang.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama Jenjang:</label>
    <input type="text" name="nama" value="{{ $data->nama }}" required>
    <button type="submit">Update</button>
</form>
@endsection
