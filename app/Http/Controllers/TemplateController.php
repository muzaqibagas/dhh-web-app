<?php

namespace App\Http\Controllers;

use App\Models\template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = template::all();

        return view('template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('template.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // Tidak ada field lain, hanya id dan timestamps
        ]);
        $insert = template::create($data);
        if ($insert) {
            return redirect()->route('template.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return back()->with('error', 'Gagal menyimpan data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(template $template)
    {
        return view('template.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(template $template)
    {
        return view('template.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, template $template)
    {
        $data = $request->validate([
            // Tidak ada field lain, hanya id dan timestamps
        ]);
        $update = $template->update($data);
        if ($update) {
            return redirect()->route('template.index')->with('success', 'Data berhasil diperbarui!');
        } else {
            return back()->with('error', 'Gagal memperbarui data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(template $template)
    {
        $template->delete();

        return redirect()->route('template.index');
    }
}
