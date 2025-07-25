@extends('layouts.app')

@section('content')
    <div class="container position-relative">
        <h1>Daftar Staff Departemen</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('staffdept.create') }}" class="btn btn-primary">+ Tambah Staff</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Divisi</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffdepts as $staff)
                    <tr>
                        <td>
                            @if($staff->foto)
                                <img src="{{ asset('img/' . $staff->foto) }}" alt="Foto" width="60">
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td>{{ $staff->nama }}</td>
                        <td>{{ $staff->nip }}</td>
                        <td>{{ $staff->jabatan }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->divisi->nama ?? '-' }}</td>
                        <td>{{ $staff->kategoristaff->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('staffdept.show', $staff->id) }}" class="btn btn-primary btn-sm">show</a>
                            <a href="{{ route('staffdept.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('staffdept.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($staffdepts->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data staff</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
