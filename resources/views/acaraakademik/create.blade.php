@extends('layouts.app')

@section('content')
<h1>Tambah Acara Akademik</h1>

<form action="{{ route('acaraakademik.store') }}" method="POST">
    @csrf

    {{-- Pilih jenis acara --}}
    <label for="jenis_acara">Pilih Jenis Acara:</label>
    <select name="jenis_acara" id="jenis_acara" required onchange="tampilkanDataAcara()">
        <option value="">-- Pilih Acara --</option>
        <option value="kolokium">Kolokium</option>
        <option value="seminar">Seminar Hasil</option>
        <option value="sidang">Sidang</option>
    </select><br><br>

    {{-- Pilih Mahasiswa berdasarkan acara --}}
    <div id="mahasiswa_group" style="display:none;">
        <label for="id_mahasiswa">Mahasiswa:</label>
        <select name="id_mahasiswa" id="id_mahasiswa" required>
            <option value="">-- Pilih Mahasiswa --</option>
        </select><br><br>
    </div>

    {{-- Pilih Dosen Moderator --}}
    <div id="dosen_group" style="display:none;">
        <label for="id_staffdept">Dosen Moderator:</label>
        <select name="id_staffdept" id="id_staffdept" required>
            <option value="">-- Pilih Dosen Moderator --</option>
            @foreach($staffdepts as $dsn)
                <option value="{{ $dsn->id }}">{{ $dsn->nama }}</option>
            @endforeach
        </select><br><br>
    </div>

    {{-- Hidden input untuk ID acara terkait --}}
    <input type="hidden" name="id_kolokium" id="id_kolokium">
    <input type="hidden" name="id_seminar" id="id_seminar">
    <input type="hidden" name="id_sidang" id="id_sidang">

    <button type="submit">Simpan</button>
</form>

<script>
    const kolokiums = @json($kolokiums);
    const seminars = @json($seminars);
    const sidangs = @json($sidangs);

    function tampilkanDataAcara() {
        const jenis = document.getElementById('jenis_acara').value;
        const mahasiswaSelect = document.getElementById('id_mahasiswa');
        const kolokiumInput = document.getElementById('id_kolokium');
        const seminarInput = document.getElementById('id_seminar');
        const sidangInput = document.getElementById('id_sidang');

        mahasiswaSelect.innerHTML = '<option value="">-- Pilih Mahasiswa --</option>';
        kolokiumInput.value = '';
        seminarInput.value = '';
        sidangInput.value = '';

        let data = [];

        if (jenis === 'kolokium') {
            data = kolokiums;
        } else if (jenis === 'seminar') {
            data = seminars;
        } else if (jenis === 'sidang') {
            data = sidangs;
        }

        if (data.length > 0) {
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id_mahasiswa;
                option.textContent = item.mahasiswa?.name ?? '(Tidak diketahui)';
                option.dataset.acaraId = item.id;
                mahasiswaSelect.appendChild(option);
            });

            document.getElementById('mahasiswa_group').style.display = 'block';
            document.getElementById('dosen_group').style.display = 'block';
        }

        mahasiswaSelect.onchange = function() {
            const selected = mahasiswaSelect.options[mahasiswaSelect.selectedIndex];
            const acaraId = selected.dataset.acaraId;

            if (jenis === 'kolokium') kolokiumInput.value = acaraId;
            else if (jenis === 'seminar') seminarInput.value = acaraId;
            else if (jenis === 'sidang') sidangInput.value = acaraId;
        };
    }
</script>
@endsection