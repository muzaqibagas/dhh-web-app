<?php

namespace App\Http\Controllers;

use App\Models\StaffDept;
use App\Models\KategoriStaff;
use App\Models\Divisi;
use Illuminate\Http\Request;

class StaffDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = StaffDept::whereHas('kategoristaff'); // ⬅️ HANYA yang punya kategori

        if (request()->filled('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%');
        }

        $staffdepts = $query
            ->with(['kategoristaff', 'divisi']) // ⬅️ WAJIB (hindari N+1)
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('staffdept.index', compact('staffdepts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriStaffs = KategoriStaff::all();
        $divisis = Divisi::all();        
        return view('staffdept.create', compact('kategoriStaffs', 'divisis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        

        $staffdepts = $request->validate([            
            'id_kategoristaff' => 'required|exists:kategori_staffs,id',
            'id_divisi' => 'nullable|exists:divisis,id',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|string|max:255',
            'nip' => 'required|string|unique:staff_depts,nip',            
            'jabatan' => 'nullable|string|max:255',                        
            'email' => 'required|string|email|unique:staff_depts,email',
            'sinta' => 'nullable|string|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'scopus' => 'nullable|string|max:255',
            'researchgate' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'publikasi' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
        ], [
            'nip.unique' => 'NIP ini sudah terdaftar. Silakan gunakan NIP lain.',
            'email.unique' => 'Email ini sudah digunakan. Silakan gunakan email lain.',
        ]);

        $staffdepts['id_user'] = auth()->id();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_staffdept'), $filename);
            $staffdepts['foto'] = 'foto_staffdept/' . $filename;
        }


        $insert = StaffDept::create($staffdepts);
        if ($insert)
            return redirect()->route('staffdept.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->withInput()->with('error', 'Data tidak valid, silakan periksa kembali.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffDept $staffDept)
    {
        return view('staffdept.show', compact('staffDept'));        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffDept $staffDept)
    {
        $kategoriStaffs = KategoriStaff::all();
        $divisis = Divisi::all();        

        return view('staffdept.edit', compact('staffDept', 'kategoriStaffs', 'divisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffDept $staffDept)
{
    $data = $request->validate([                        
        'id_kategoristaff' => 'required|exists:kategori_staffs,id',
        'id_divisi' => 'nullable|exists:divisis,id',
        'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'nama' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|string|max:255',
        'nip' => 'required|string|unique:staff_depts,nip,' . $staffDept->id,
        'jabatan' => 'nullable|string|max:255',            
        'email' => 'required|string|email|unique:staff_depts,email,' . $staffDept->id,
        'sinta' => 'nullable|string|max:255',
        'google_scholar' => 'nullable|string|max:255',
        'scopus' => 'nullable|string|max:255',
        'researchgate' => 'nullable|string|max:255',
        'website' => 'nullable|string|max:255',
        'keahlian' => 'nullable|string',
        'publikasi' => 'nullable|string',
        'riwayat_pendidikan' => 'nullable|string',
    ]);

    // Kalau ada upload foto baru
    if ($request->hasFile('foto')) {
        // hapus foto lama kalau ada
        if ($staffDept->foto && file_exists(public_path($staffDept->foto))) {
            unlink(public_path($staffDept->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto_staffdept'), $filename);
        $data['foto'] = 'foto_staffdept/' . $filename;
    } else {
        // kalau tidak upload, tetap pakai foto lama
        $data['foto'] = $staffDept->foto;
    }

    $staffDept->fill($data);
    if (!$staffDept->isDirty()) {
        return back()->with('info', 'Tidak ada perubahan data yang dilakukan!');
    }

    $staffDept->update($data);

    return redirect()->route('staffdept.index')->with('success', 'Data Pimpinan DHH Berhasil Diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffDept $staffDept)
    {
        if ($staffDept->foto && file_exists(public_path($staffDept->foto))) {
            unlink(public_path($staffDept->foto));
        }

        $nama = $staffDept->nama; // simpan nama dulu sebelum delete

        $staffDept->delete();
        return redirect()->route('staffdept.index')->with('success', "Data $nama berhasil dihapus");
    }
}
