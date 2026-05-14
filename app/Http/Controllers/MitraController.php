<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Mitra::query();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where('nama', 'like', "%$search%");
        }

        $mitras = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();

        return view('mitra.index', compact('mitras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data['id_user'] = auth()->id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('foto_mitra'), $filename);
            $data['foto'] = 'foto_mitra/'.$filename;
        }

        $insert = Mitra::create($data);
        if ($insert) {
            return redirect()->route('mitra.index')->with('success', 'Data Mitra Berhasil Ditambahkan');
        } else {
            return redirect()->route('error', 'gagal menyimpan data mitra');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        return view('mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // handle gambar
        if ($request->hasFile('foto')) {
            if ($mitra->foto && file_exists(public_path($mitra->foto))) {
                unlink(public_path($mitra->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('foto_mitra'), $filename);
            $data['foto'] = 'foto_mitra/'.$filename;
        }

        $mitra->fill($data);

        if (! $mitra->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $mitra->update($data);
        if ($update) {
            return redirect()->route('mitra.index')->with('success', 'Data Mitra Berhasil Diupdate');
        } else {
            return redirect()->route('error', 'gagal mengupdate data mitra');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        if ($mitra->foto && file_exists(public_path($mitra->foto))) {
            unlink(public_path($mitra->foto));
        }

        $nama = $mitra->nama; // simpan nama dulu sebelum delete

        $mitra->delete();

        return redirect()->route('mitra.index')->with('success', "Data $nama berhasil dihapus");
    }
}
