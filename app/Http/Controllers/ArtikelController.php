<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\Sdgs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $sdgs = Sdgs::all();
        return view('artikel.index', compact('artikels', 'sdgs'));
    }

    public function artikel(Request $request)
    {                          
        $query = Artikel::with('kategoriartikel', 'user')
                ->orderBy('tanggal', 'DESC')
                ->orderBy('created_at', 'DESC');                

        if ($request->has('q') && $request->q != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'LIKE', "%" . $request->q . "%");                
            });
        }

        $artikels = $query->get();

        $featured = $artikels->take(4);

        // Sisanya (acak)
        $random = $artikels->skip(4)->shuffle();

        $perPage = 6; // 3 kolom × 2 item
        $currentPage = request()->get('page', 1);

        $currentItems = $random->forPage($currentPage, $perPage);

        $pagination = new LengthAwarePaginator(
            $currentItems,
            $random->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $latestArtikels = Artikel::orderBy('tanggal', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->take(5)
                        ->get();

        $kategoris = KategoriArtikel::whereHas('artikel')->get();
        $sdgs = Sdgs::all();
        $keyword = $request->q ?? null;
        return view('artikel.artikels', compact('artikels', 'kategoris', 'keyword', 'latestArtikels', 'sdgs', 'featured', 'pagination'));
    }

    public function filterByKategori($kategoriId)
    {
        $artikels = Artikel::with('kategoriartikel', 'user')
                            ->where('id_kategoriartikel', $kategoriId)
                            ->orderBy('tanggal', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->get();

        $kategoris = KategoriArtikel::whereHas('artikel')->get();
        $sdgs = Sdgs::all();

        $latestArtikels = Artikel::orderBy('tanggal', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->take(5)
                            ->get();

        $keyword = null;
        $isKategori = true;

        return view('artikel.artikels', compact('artikels', 'kategoris', 'latestArtikels', 'sdgs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriartikel = KategoriArtikel::all();
        $sdgs = Sdgs::all();
        return view('artikel.create', compact('kategoriartikel', 'sdgs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'id_kategoriartikel' => 'nullable|exists:kategori_artikels,id',
            'id_sdgs' => 'nullable|exists:sdgs,id',
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
        
        $latestArtikels = Artikel::orderBy('tanggal', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->take(5)
                        ->get();

        $kategoris = KategoriArtikel::whereHas('artikel')->get();
        $sdgs = Sdgs::all();                  

        return view('artikel.show', compact('artikel', 'kategoris','latestArtikels', 'sdgs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $kategoriartikel = KategoriArtikel::all();
        $sdgs = Sdgs::all();
        return view('artikel.edit', compact('artikel', 'kategoriartikel', 'sdgs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',                   
            'id_kategoriartikel' => 'nullable|exists:kategori_artikels,id',             
            'id_sdgs' => 'nullable|exists:sdgs,id',
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
