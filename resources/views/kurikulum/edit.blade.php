@extends('layouts.app')

@section('content')
<h1>Edit Kurikulum</h1>

<form action="{{ route('kurikulum.update', $kurikulum->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>User:</label>
    <select name="id_user" required>
        <option value="">-- Pilih User --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $kurikulum->id_user ? 'selected' : '' }}>
                {{ $user->nama }}
            </option>
        @endforeach
    </select>

    <br>

    <label>Jenjang:</label>
    <select name="id_jenjang" required>
        <option value="">-- Pilih Jenjang --</option>
        @foreach ($jenjangs as $jenjang)
            <option value="{{ $jenjang->id }}" {{ $jenjang->id == $kurikulum->id_jenjang ? 'selected' : '' }}>
                {{ $jenjang->nama}}
            </option>
        @endforeach
    </select>

    <br>

    <label>Nama Kurikulum:</label>
    <input type="text" name="nama" value="{{ $kurikulum->nama }}" required>

    <br>

    <label>Tahun:</label>
    <input type="text" name="tahun" value="{{ $kurikulum->tahun }}" required>

    <br>   

    <br><br>

    <button type="submit">Perbarui</button>
</form>
@endsection
