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
            'id_user' => 'required|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);
        $insert = ReviewAlumni::create($data);
        if ($insert)
            return redirect()->route('reviewalumni.index')->with('success', 'Data berhasil disimpan!');
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
            'id_user' => 'required|exists:users,id',
            'nama' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);
        $update = $reviewAlumni->update($data);
        if ($update)
            return redirect()->route('reviewalumni.index')->with('success', 'Data berhasil diperbarui!');
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewAlumni $reviewAlumni)
    {
        $reviewAlumni->delete();
        return redirect()->route('reviewalumni.index');
    }
}
