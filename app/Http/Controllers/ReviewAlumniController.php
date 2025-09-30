<?php

namespace App\Http\Controllers;

use App\Models\ReviewAlumni;
use Illuminate\Http\Request;

class ReviewAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = ReviewAlumni::all();
        return view('reviewalumni.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviewalumni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'profesi' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data['id_user'] = auth()->id();        

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_alumni'), $filename);
            $data['foto'] = 'foto_alumni/' . $filename;
        }

        $insert = ReviewAlumni::create($data);
        if ($insert)
            return redirect()->route('review-alumni.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReviewAlumni $reviewAlumni)
    {
        return view('reviewalumni.show', compact('reviewAlumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewAlumni $reviewAlumni)
    {
        return view('reviewalumni.edit', compact('reviewAlumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewAlumni $reviewAlumni)
    {
        $data = $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'profesi' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data['id_user'] = auth()->id();

        if ($request->hasFile('foto')) {
            if ($reviewAlumni->foto && file_exists(public_path($reviewAlumni->foto))) {
                unlink(public_path($reviewAlumni->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_alumni'), $filename);
            $data['foto'] = 'foto_alumni/' . $filename;
        }

        $update = $reviewAlumni->update($data);
        if ($update)
            return redirect()->route('review-alumni.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewAlumni $reviewAlumni)
    {
        $reviewAlumni->delete();
        return redirect()->route('review-alumni.index');
    }
}
