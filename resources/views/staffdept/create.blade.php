@extends('layouts.app')

@section('content')
<form action="{{ route('staffdept.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Nama -->
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required><br>

    <!-- Kategori -->
    <label for="id_kategori">Kategori:</label>
    <select name="id_kategori" id="kategoriSelect" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoriStaffs as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
        @endforeach
    </select><br>

    <!-- Divisi -->
    <div id="divisiContainer" style="display: none;">
        <label for="id_divisi">Divisi:</label>
        <select name="id_divisi">
            <option value="">-- Pilih Divisi --</option>
            @foreach($divisis as $divisi)
                <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
            @endforeach
        </select>
    </div><br>

    <!-- Submit -->
    <button type="submit">Simpan</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategoriSelect');
        const divisiContainer = document.getElementById('divisiContainer');

        kategoriSelect.addEventListener('change', function () {
            const selectedText = kategoriSelect.options[kategoriSelect.selectedIndex].text;
            if (selectedText === 'Divisi') {
                divisiContainer.style.display = 'block';
            } else {
                divisiContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
