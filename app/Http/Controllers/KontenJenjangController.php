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
        $kontenJenjangs = KontenJenjang::with('jenjang')->get();
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
            'foto' => 'nullable|image',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuanpendidikan' => 'nullable|string',
            'kompetensilulusan' => 'nullable|string',
            'capaianpembelajaran' => 'nullable|string',
            'leaflet' => 'nullable|image',
            'sertifikatakreditasi' => 'nullable|image',
        ]);

        // handle file upload
        foreach (['foto', 'leaflet', 'sertifikatakreditasi'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('uploads', 'public');
            }
        }

        KontenJenjang::create($validated);

        return redirect()->route('kontenjenjangs.index')->with('success', 'Konten jenjang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('kontenjenjang.edit', compact('kontenJenjang'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'profil' => 'nullable|string',
            'foto' => 'nullable|image',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuanpendidikan' => 'nullable|string',
            'kompetensilulusan' => 'nullable|string',
            'capaianpembelajaran' => 'nullable|string',
            'leaflet' => 'nullable|image',
            'sertifikatakreditasi' => 'nullable|image',
        ]);

        foreach (['foto', 'leaflet', 'sertifikatakreditasi'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('uploads', 'public');
            }
        }

        $kontenJenjang->update($validated);

        return redirect()->route('kontenjenjang.index')->with('success', 'Konten jenjang berhasil diperbarui.');
    }

    public function show(KontenJenjang $kontenJenjang)
    {
        return view('kontenjenjang.show', compact('kontenJenjang'));
    }
}