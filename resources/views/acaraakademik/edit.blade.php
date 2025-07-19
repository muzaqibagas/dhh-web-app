@extends('layouts.app')

@section('content')
<h1>Edit Acara Akademik</h1>
<form action="{{ url('acara-akademik/' . $acaraAkademik->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>ID Mahasiswa:</label>
    <input type="text" name="id_mahasiswa" value="{{ $acaraAkademik->id_mahasiswa }}"><br>
    <label>ID Staff Dept:</label>
    <input type="text" name="id_staffdept" value="{{ $acaraAkademik->id_staffdept }}"><br>
    <label>ID Kolokium:</label>
    <input type="text" name="id_kolokium" value="{{ $acaraAkademik->id_kolokium }}"><br>
    <label>ID Seminar:</label>
    <input type="text" name="id_seminar" value="{{ $acaraAkademik->id_seminar }}"><br>
    <label>ID Sidang:</label>
    <input type="text" name="id_sidang" value="{{ $acaraAkademik->id_sidang }}"><br>
    <button type="submit">Update</button>
</form>
@endsection
