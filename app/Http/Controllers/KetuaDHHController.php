<?php

namespace App\Http\Controllers;

use App\Models\KetuaDHH;
use Illuminate\Http\Request;

class KetuaDHHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = KetuaDHH::query();        
        if (request()->has('search')){
            $search = request()->search;
            $query->where('nama', 'like', "%$search%");
        }

        $ketua_dhhs = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();                
        return view('ketuadhh.index', compact('ketua_dhhs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ketuadhh.create');
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
            'tahun_mulai' => 'required|integer|min:1900|max:' . (date('Y')+10),
            'tahun_selesai' => 'required|integer|min:1900|max:' . (date('Y')+10),
        ]);

        $data['id_user'] = auth()->id();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_ketuadhh'), $filename);
            $data['foto'] = 'foto_ketuadhh/' . $filename;
        }

        $insert = KetuaDHH::create($data);
        if ($insert)
            return redirect()->route('ketuadhh.index')->with('success', 'Data Pimpinan DHH Berhasil Ditambahkan');
        else
            return redirect()->route('error', 'gagal menyimpan data ketua dhh');
    }

    /**
     * Display the specified resource.
     */
    public function show(KetuaDHH $ketuaDHH)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KetuaDHH $ketuaDHH)
    {
        return view('ketuadhh.edit', compact('ketuaDHH'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KetuaDHH $ketuaDHH)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tahun_mulai' => 'required|integer|min:1900|max:' . (date('Y')+10),
            'tahun_selesai' => 'required|integer|min:1900|max:' . (date('Y')+10),
        ]);

        // handle gambar
        if ($request->hasFile('foto')) {
            if ($ketuaDHH->foto && file_exists(public_path($ketuaDHH->foto))) {
                unlink(public_path($ketuaDHH->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_ketuadhh'), $filename);
            $data['foto'] = 'foto_ketuadhh/' . $filename;
        }

        $ketuaDHH->fill($data);

        if (!$ketuaDHH->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $ketuaDHH->update($data);
        if ($update)
            return redirect()->route('ketuadhh.index')->with('success', 'Data Pimpinan DHH Berhasil Diupdate');
        else
            return redirect()->route('error', 'Gagal mengupdate data ketua dhh');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KetuaDHH $ketuaDHH)
    {
        if ($ketuaDHH->foto && file_exists(public_path($ketuaDHH->foto))) {
            unlink(public_path($ketuaDHH->foto));
        }

        $nama = $ketuaDHH->nama; // simpan nama dulu sebelum delete

        $ketuaDHH->delete();
        return redirect()->route('ketuadhh.index')->with('success', "Data $nama berhasil dihapus");
    }
}
