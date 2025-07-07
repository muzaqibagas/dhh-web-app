@extends('layouts.app')

@section('content')
<h1>Tambah Kurikulum</h1>

<form action="{{ route('kurikulum.store') }}" method="POST">
    @csrf
    <label>User:</label>
    <select name="id_user" required>
        <option value="">-- Pilih User --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->nama }}</option>
        @endforeach
    </select>

    <label>Jenjang:</label>
    <select name="id_jenjang" required>
        <option value="">-- Pilih Jenjang --</option>
        @foreach ($jenjangs as $jenjang)
            <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
        @endforeach
    </select>
    <label>Nama Kurikulum:</label>
    <input type="text" name="nama" required>
    <label>Tahun:</label>
    <input type="text" name="tahun" required>
    <button type="submit">Simpan</button>
</form>
@endsection
