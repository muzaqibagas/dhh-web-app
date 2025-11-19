<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $query = Galeri::query();        
        if (request()->has('search')){
            $search = request()->search;
            $query->where('judul', 'like', "%$search%");
        }        
        $galeris = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategorigaleri = KategoriGaleri::all();
        return view('galeri.create', compact('kategorigaleri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategorigaleri' => 'required|exists:kategori_galeris,id',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'tipe' => 'required|in:gambar,video',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',            
            'video_url' => 'nullable|url'
        ]);

        if ($request->tipe == 'gambar' && $request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('galeri_upload/gambar'), $filename);
            $data['gambar'] = 'galeri_upload/gambar/' . $filename;
            $data['video'] = null;
        }

        if ($request->tipe == 'video') {
            $data['video'] = $request->video_url;  
            $data['gambar'] = null;
        }

        $data['id_user'] = auth()->id();

        $insert = Galeri::create($data);
        if ($insert)
            return redirect()->route('galeri.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {        
        $kategorigaleri = KategoriGaleri::all();
        return view('galeri.edit', compact('galeri', 'kategorigaleri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'id_kategorigaleri' => 'required|exists:kategori_galeris,id',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'tipe' => 'required|in:gambar,video',
            'video_url' => 'nullable|string|max:255',            
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        // Handle gambar
        if ($request->tipe == 'gambar' && $request->hasFile('gambar')) {
            if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
                unlink(public_path($galeri->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('galeri_upload/gambar'), $filename);
            $data['gambar'] = 'galeri_upload/gambar/' . $filename;
            $data['video'] = null;
        }

        // Handle video
        if ($request->tipe == 'video') {
            if ($galeri->video && !filter_var($galeri->video, FILTER_VALIDATE_URL) && file_exists(public_path($galeri->video))) {
                unlink(public_path($galeri->video));
            }
            $data['video'] = $request->video_url;
            $data['gambar'] = null;
        }
    
        $data['id_user'] = auth()->id();

        $galeri->fill($data);

        if (!$galeri->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan pada data.');
        }

        $update = $galeri->update($data);
        if ($update)
            return redirect()->route('galeri.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        // Hapus file gambar jika ada
        if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
            unlink(public_path($galeri->gambar));
        }
        // Hapus file video jika ada dan bukan URL
        if ($galeri->video && !filter_var($galeri->video, FILTER_VALIDATE_URL) && file_exists(public_path($galeri->video))) {
            unlink(public_path($galeri->video));
        }

        $galeri->delete();
        return redirect()->route('galeri.index');
    }
}
