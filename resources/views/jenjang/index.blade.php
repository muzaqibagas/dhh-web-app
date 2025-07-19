@extends('layouts.app')

@section('content')
<h1>Daftar Jenjang</h1>

{{-- Form Pencarian --}}
<form action="{{ route('jenjang.index') }}" method="GET">
    <input type="text" name="search" placeholder="Cari jenjang..." value="{{ request('search') }}">
    <button type="submit">Cari</button>    
</form>

<a href="{{ route('jenjang.create') }}">Tambah Data</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<ul>
@foreach($data as $item)
    <li>
        {{ $item->nama }}
        <a href="{{ route('jenjang.edit', $item->id) }}">Edit</a>
        <form action="{{ route('jenjang.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')            
            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
