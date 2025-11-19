<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                  
        $query = Artikel::query();        
        if (request()->has('search')){
            $search = request()->search;
            $query->where('judul', 'like', "%$search%");
        }

        $artikels = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();                
        return view('artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriartikel = KategoriArtikel::all();
        return view('artikel.create', compact('kategoriartikel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'id_kategoriartikel' => 'nullable|exists:kategori_artikels,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',            
            'deskripsi' => 'nullable|string|max:5000',
        ]);            

        $kataHubung = [
            'dan', 'atau', 'tetapi', 'serta', 'dengan', 'ke', 'di', 'dari', 'untuk', 'pada', 'yang', 'dalam', 'agar', 'karena', 'sebagai', 'oleh', 'hingga', 'sehingga', 'supaya', 'bahwa', 'jika', 'bila', 'walaupun', 'meskipun', 'namun'
        ];

        if (!empty($data['judul'])) {
            $data['judul'] = implode(' ', array_map(function($word, $idx) use ($kataHubung) {
                $word = strtolower($word);
                if ($idx !== 0 && in_array($word, $kataHubung)) {
                    return $word;
                }
                return ucfirst($word);
            }, explode(' ', $data['judul']), array_keys(explode(' ', $data['judul']))));
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('foto_artikel'), $filename);
            
            $data['foto'] = 'foto_artikel/' . $filename;
        }

        $data['id_user'] = auth()->id();        

        $insert = Artikel::create($data);
        if ($insert)
            return redirect()->route('artikel.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $kategoriartikel = KategoriArtikel::all();
        return view('artikel.edit', compact('artikel', 'kategoriartikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',                   
            'id_kategoriartikel' => 'nullable|exists:kategori_artikels,id',             
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);

        $data['id_user'] = auth()->id();

        $kataHubung = [
            'dan', 'atau', 'tetapi', 'serta', 'dengan', 'ke', 'di', 'dari', 'untuk', 'pada', 'yang', 'dalam', 'agar', 'karena', 'sebagai', 'oleh', 'hingga', 'sehingga', 'supaya', 'bahwa', 'jika', 'bila', 'walaupun', 'meskipun', 'namun'
        ];

        if (!empty($data['judul'])) {
            $data['judul'] = implode(' ', array_map(function($word, $idx) use ($kataHubung) {
                $word = strtolower($word);
                if ($idx !== 0 && in_array($word, $kataHubung)) {
                    return $word;
                }
                return ucfirst($word);
            }, explode(' ', $data['judul']), array_keys(explode(' ', $data['judul']))));
        }

        if ($request->hasFile('foto')) {
            if ($artikel->foto && file_exists(public_path($artikel->foto))) {
                unlink(public_path($artikel->foto));
            }   

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_artikel'), $filename);
            $data['foto'] = 'foto_artikel/' . $filename;
        }        
        
        $artikel->fill($data);
        
        if (!$artikel->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
        }

        $update = $artikel->update($data);
        if ($update)
            return redirect()->route('artikel.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->foto && file_exists(public_path($artikel->foto))) {
            unlink(public_path($artikel->foto));
        }
        
        $artikel->delete();
        return redirect()->route('artikel.index');
    }
}
