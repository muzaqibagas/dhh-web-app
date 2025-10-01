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
        $staffdepts = StaffDept::all();
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|string|max:255',
            'nip' => 'required|string|unique:staff_depts,nip',            
            'jabatan' => 'nullable|string|max:255',            
            'email' => 'required|string|email|unique:staff_depts,email,',
            'keahlian' => 'nullable|string',
            'sinta' => 'nullable|string|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'scopus' => 'nullable|string|max:255',
            'researchgate' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'minat_penelitian' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->getClientOriginalName(); 

            $filePath = public_path('img/' . $filename);
            
            if (!file_exists($filePath)) {
                $file->move(public_path('img'), $filename);
            }

            $staffdepts['foto'] = $filename;
        }


        $insert = StaffDept::create($staffdepts);
        if ($insert)
            return redirect()->route('staffdept.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
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
        $staffdepts = $request->validate([                        
            'id_kategoristaff' => 'required|exists:kategori_staffs,id',
            'id_divisi' => 'nullable|exists:divisis,id',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|string|max:255',
            'nip' => 'required|string|unique:staff_depts,nip,' . $staffDept->id,
            'jabatan' => 'nullable|string|max:255',            
            'email' => 'required|string|email|unique:staff_depts,email,' . $staffDept->id,
            'keahlian' => 'nullable|string',
            'sinta' => 'nullable|string|max:255',
            'google_scholar' => 'nullable|string|max:255',
            'scopus' => 'nullable|string|max:255',
            'researchgate' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'minat_penelitian' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_staffdept'), $filename);
            $data['foto'] = 'foto_staffdept/' . $filename;
        }

        $staffDept->fill($data);

        if (!$staffDept->isDirty()) {
            return back()->with('info', 'Tidak ada data yang diubah');
        }

        $update = $staffDept->update($data);
        if ($update)
            return redirect()->route('staffdept.index')->with('success', 'Data Pimpinan DHH Berhasil Diupdate');
        else
            return redirect()->route('error', 'Gagal mengupdate data ketua dhh');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffDept $staffDept)
    {
        if ($staffdept->foto && file_exists(public_path($staffdept->foto))) {
            unlink(public_path($staffdept->foto));
        }

        $nama = $staffdept->nama; // simpan nama dulu sebelum delete

        $staffdept->delete();
        return redirect()->route('staffdept.index')->with('success', "Data $nama berhasil dihapus");
    }
}
