<?php

namespace App\Http\Controllers;

use App\Models\KontenJenjang;
use App\Models\LeafletJenjang;
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
            'leaflet.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sertifikatakreditasi' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'deskripsiakreditasi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('leaflet') && count($request->file('leaflet')) > 2) {
            return back()->withErrors(['leaflet' => 'Maksimal upload 2 leaflet!']);
        }

        $directories = [
            'foto' => 'foto_jenjang/foto',
            'leaflet' => 'foto_jenjang/leaflet',
            'sertifikatakreditasi' => 'foto_jenjang/sertifikatakreditasi',
        ];

        // upload foto & sertifikat
        foreach ($directories as $field => $path) {
            if ($field === 'leaflet') continue;

            if ($request->hasFile($field)) {

                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $file = $request->file($field);
                $filename = uniqid() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $filename);

                $validated[$field] = $path . '/' . $filename;
            }
        }

        // pastikan leaflet tidak ikut ke kontenjenjang
        unset($validated['leaflet']);

        // simpan konten jenjang
        $konten = KontenJenjang::create($validated);

        // upload leaflet multiple
        if ($request->hasFile('leaflet')) {
            foreach ($request->file('leaflet') as $file) {
                $path = $directories['leaflet'];

                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $filename = uniqid() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $filename);

                LeafletJenjang::create([
                    'id_kontenjenjang' => $konten->id,
                    'gambar' => $path . '/' . $filename,
                ]);
            }
        }

        return redirect()->route('kontenjenjang.index')
            ->with('success', 'Konten jenjang berhasil ditambahkan.');
    }

    public function pendidikanS1()
    {
        $data = KontenJenjang::with(['jenjang', 'leaflets'])
            ->whereHas('jenjang', fn($q) => $q->where('nama', 'S1'))
            ->first();

        if (!$data) {
            return view('kontenjenjang.pendidikans1')->with('data', null);
        }

        return view('kontenjenjang.pendidikans1', compact('data'));
    }

    public function pendidikanS2()
    {
        $data = KontenJenjang::with(['jenjang', 'leaflets'])
            ->whereHas('jenjang', fn($q) => $q->where('nama', 'S2'))
            ->first();

        return view('kontenjenjang.pendidikans2', compact('data'));
    }

    public function pendidikanS3()
    {
        $data = KontenJenjang::with(['jenjang', 'leaflets'])
            ->whereHas('jenjang', fn($q) => $q->where('nama', 'S3'))
            ->first();

        return view('kontenjenjang.pendidikans3', compact('data'));
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
            'leaflet.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sertifikatakreditasi' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'deskripsiakreditasi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('leaflet') && count($request->file('leaflet')) > 2) {
            return back()->withErrors(['leaflet' => 'Maksimal upload 2 leaflet!'])->withInput();
        }

        $directories = [
            'foto' => 'foto_jenjang/foto',
            'leaflet' => 'foto_jenjang/leaflet',
            'sertifikatakreditasi' => 'foto_jenjang/sertifikatakreditasi',
        ];

        foreach (['foto', 'sertifikatakreditasi'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

                if (!file_exists(public_path($directories[$field]))) {
                    mkdir(public_path($directories[$field]), 0777, true);
                }

                // hapus file lama kalau ada
                if ($kontenJenjang->$field && file_exists(public_path($kontenJenjang->$field))) {
                    @unlink(public_path($kontenJenjang->$field));
                }

                $file->move(public_path($directories[$field]), $filename);
                $validated[$field] = $directories[$field] . '/' . $filename;
            }
        }

        // proses leaflet multiple
        $hasLeafletUpload = false;
        if ($request->hasFile('leaflet')) {
            $hasLeafletUpload = true;
            // hapus file leaflet lama dan recordnya
            if ($kontenJenjang->leaflets && $kontenJenjang->leaflets->count()) {
                foreach ($kontenJenjang->leaflets as $old) {
                    if ($old->gambar && file_exists(public_path($old->gambar))) {
                        @unlink(public_path($old->gambar));
                    }
                    $old->delete();
                }
            }

            // simpan leaflet baru
            foreach ($request->file('leaflet') as $file) {
                $path = $directories['leaflet'];
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $filename = uniqid() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $filename);

                LeafletJenjang::create([
                    'id_kontenjenjang' => $kontenJenjang->id,
                    'gambar' => $path . '/' . $filename,
                ]);
            }
        }

        if (isset($validated['leaflet'])) unset($validated['leaflet']);

        $kontenJenjang->fill($validated);
        if (!$kontenJenjang->isDirty() && !$hasLeafletUpload) {
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