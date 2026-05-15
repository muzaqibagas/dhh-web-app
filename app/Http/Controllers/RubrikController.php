<?php

namespace App\Http\Controllers;

use App\Models\Rubrik;
use Illuminate\Http\Request;

class RubrikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Rubrik::query();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where('nama_kriteria', 'like', "%$search%");
        }
        $rubriks = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();

        $totalKolokium = Rubrik::where('jenis_sidang', 'kolokium')->sum('bobot');
        $totalSeminar = Rubrik::where('jenis_sidang', 'seminar')->sum('bobot');
        $totalKomprehensif = Rubrik::where('jenis_sidang', 'komprehensif')->sum('bobot');

        return view('rubriks.index', compact(
            'rubriks', 
            'totalKolokium', 
            'totalSeminar', 
            'totalKomprehensif'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rubriks = Rubrik::all();

        $totalKolokium = Rubrik::where('jenis_sidang', 'kolokium')->sum('bobot');
        $totalSeminar = Rubrik::where('jenis_sidang', 'seminar')->sum('bobot');
        $totalKomprehensif = Rubrik::where('jenis_sidang', 'komprehensif')->sum('bobot');

        return view('rubriks.create', compact(
            'rubriks',
            'totalKolokium',
            'totalSeminar',
            'totalKomprehensif'
            ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'jenis_sidang' => 'required|in:kolokium,seminar,komprehensif',
        ]);

        $totalBobot = Rubrik::where('jenis_sidang', $request->jenis_sidang)->sum('bobot');

        if ($totalBobot >= 100) {
            return redirect()->back()
                ->with('error', "Total bobot untuk kegiatan {$request->jenis_sidang} ini sudah 100%. Tidak dapat menambah rubrik lagi.");
        }

        if ($totalBobot == 100) {
            return redirect(route('rubrik.index'))
                ->with('success', "Total bobot rubrik untuk kegiatan {$request->jenis_sidang} ini sudah 100% dan siap digunakan");                                   
        }                 

        if ($request->bobot == 0) {
            return redirect()->back()
                ->with('error', 'Bobot tidak boleh 0%.');
        }

        if ($request->bobot < 0) {
            return redirect()->back()
                ->with('error', 'Bobot tidak boleh negatif.');
        }        

        if (($totalBobot + $request->bobot) > 100) {
            return redirect()->back()
                ->with('error', 'Total bobot melebihi 100%.');
        }

        $insert = Rubrik::create([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_sidang' => $request->jenis_sidang,
        ]);

        if ($insert) {
            return redirect()->route('rubrik.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('rubrik.index')->with('error', 'Data gagal disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rubrik $rubrik)
    {
        return view('rubriks.show', compact('rubrik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rubrik $rubrik)
    {
        $totalKolokium = Rubrik::where('jenis_sidang', 'kolokium')->sum('bobot');
        $totalSeminar = Rubrik::where('jenis_sidang', 'seminar')->sum('bobot');
        $totalKomprehensif = Rubrik::where('jenis_sidang', 'komprehensif')->sum('bobot');

        return view('rubriks.edit', compact(
            'rubrik',
            'totalKolokium',
            'totalSeminar',
            'totalKomprehensif'
            ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rubrik $rubrik)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'jenis_sidang' => 'required|in:kolokium,seminar,komprehensif',
        ]);

        $totalBobot = Rubrik::where('jenis_sidang', $request->jenis_sidang)
            ->where('id', '!=', $rubrik->id)
            ->sum('bobot');        

        if ($totalBobot >= 100) {
            return redirect()->back()
                ->with('error', "Total bobot untuk kegiatan {$request->jenis_sidang} ini sudah 100%. Tidak dapat menambah rubrik lagi.");
        }

        if ($totalBobot == 100) {
            return redirect(route('rubrik.index'))
                ->with('success', "Total bobot rubrik untuk kegiatan {$request->jenis_sidang} ini sudah 100% dan siap digunakan");                                   
        }                 

        if ($request->bobot == 0) {
            return redirect()->back()
                ->with('error', 'Bobot tidak boleh 0%.');
        }

        if ($request->bobot < 0) {
            return redirect()->back()
                ->with('error', 'Bobot tidak boleh negatif.');
        }        

        if (($totalBobot + $request->bobot) > 100) {
            return redirect()->back()
                ->with('error', 'Total bobot melebihi 100%.');
        }    

        $rubrik->fill([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_sidang' => $request->jenis_sidang,
        ]);

        if (! $rubrik->isDirty()) {
            return back()->with('info', 'Tidak ada perubahan data.');
        }

        if ($rubrik->save()) {
            return redirect()->route('rubrik.index')->with('success', 'Data berhasil diperbarui.');
        } else {
            return back()->with('error', 'Data gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rubrik $rubrik)
    {
        $rubrik->delete();

        return redirect()->route('rubrik.index')->with('success', 'Data berhasil dihapus.');
    }
}
