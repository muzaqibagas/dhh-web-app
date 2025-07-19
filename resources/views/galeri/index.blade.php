@extends('layouts.app')

@section('content')
    <h1>Daftar Galeri</h1>

    <a href="{{ route('galeri.create') }}">Tambah Galeri</a>

    <ul>
        @foreach($galeris as $galeri)
            <li>
                <a href="{{ route('galeri.show', $galeri->id) }}">
                    {{ $galeri->judul }}
                </a>
                | <a href="{{ route('galeri.edit', $galeri->id) }}">Edit</a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
