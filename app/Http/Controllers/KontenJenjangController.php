<?php

namespace App\Http\Controllers;

use App\Models\KontenJenjang;
use App\Models\Jenjang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontenJenjangController extends Controller
{
    // Daftar jenjang paten
    private $jenjangList = ['S1', 'S2', 'S3'];

    public function index()
    {                
        $query = KontenJenjang::with('jenjang');   

        if (request()->has('search')){
            $search = request()->search;
            $query->whereHas('jenjang', function($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            });
        }

        $kontenJenjangs = $query->get();
        return view('kontenjenjang.index', compact('kontenJenjangs'));
    }

    public function create(Request $request)
    {
        // Ambil jenjang yang BELUM punya konten
        $jenjangs = Jenjang::whereDoesntHave('konten')->get();

        return view('kontenjenjang.create', compact('jenjangs'));
    }
    
    public function store(Request $request)
        {
        $validated = $request->validate([
            'id_jenjang' => 'required|exists:jenjangs,id|unique:konten_jenjangs,id_jenjang',
            'profil' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuanpendidikan' => 'nullable|string',
            'kompetensilulusan' => 'nullable|string',
            'capaianpembelajaran' => 'nullable|string',
            'leaflet' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sertifikatakreditasi' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'deskripsiakreditasi' => 'nullable|string|max:255',            
        ]);

        // handle file upload
         $directories = [
            'foto' => 'foto_jenjang/foto',
            'leaflet' => 'foto_jenjang/leaflet',
            'sertifikatakreditasi' => 'foto_jenjang/sertifikatakreditasi',
        ];

        foreach ($directories as $field => $path) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

                // bikin folder kalau belum ada
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $file->move(public_path($path), $filename);
                $validated[$field] = $path . '/' . $filename;
            }
        }

        KontenJenjang::create($validated);

        return redirect()->route('kontenjenjang.index')->with('success', 'Konten jenjang berhasil ditambahkan.');
    }

    public function show(KontenJenjang $kontenJenjang)
    {
        return view('kontenjenjang.show', compact('kontenJenjang'));
    }

    public function edit(KontenJenjang $kontenJenjang)
    {
        return view('kontenjenjang.edit', compact('kontenJenjang'));        
    }


    public function update(Request $request, KontenJenjang $kontenJenjang)
    {
        $validated = $request->validate([
            'profil' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuanpendidikan' => 'nullable|string',
            'kompetensilulusan' => 'nullable|string',
            'capaianpembelajaran' => 'nullable|string',
            'leaflet' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sertifikatakreditasi' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'deskripsiakreditasi' => 'nullable|string|max:255',
        ]);

        $directories = [
            'foto' => 'foto_jenjang/foto',
            'leaflet' => 'foto_jenjang/leaflet',
            'sertifikatakreditasi' => 'foto_jenjang/sertifikatakreditasi',
        ];

        foreach ($directories as $field => $path) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

                // bikin folder kalau belum ada
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                // hapus file lama kalau ada
                if ($kontenJenjang->$field && file_exists(public_path($kontenJenjang->$field))) {
                    unlink(public_path($kontenJenjang->$field));
                }

                $file->move(public_path($path), $filename);
                $validated[$field] = $path . '/' . $filename;
            }
        }

        $kontenJenjang->fill($validated);
        if (!$kontenJenjang->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $kontenJenjang->update($validated);
        if ($update)
            return redirect()->route('kontenjenjang.index')->with('success', 'Konten jenjang berhasil diperbarui.');
        else
            return back()->with('error', 'Konten jenjang gagal diperbarui.');
    }   
    
    public function destroy(KontenJenjang $kontenJenjang)
    {
        // Hapus file terkait jika ada
        foreach (['foto', 'leaflet', 'sertifikatakreditasi'] as $field) {
            if ($kontenJenjang->$field && file_exists(public_path($kontenJenjang->$field))) {
                unlink(public_path($kontenJenjang->$field));
            }
        }

        $kontenJenjang->delete();

        return redirect()->route('kontenjenjang.index')->with('success', 'Konten jenjang berhasil dihapus.');
    }
}