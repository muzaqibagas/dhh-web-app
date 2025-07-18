<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class KategoriController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        try {
            $kategoris = Kategori::with('tipe')->latest()->get();
            return response()->json($kategoris);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data kategori', 'message' => $e->getMessage()], 500);
        }
    }

    // POST /api/kategori
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_tipe' => 'required|exists:tipes,id',
                'nama' => 'nullable|string|max:255',
            ]);

            $kategori = Kategori::create($validated);

            return response()->json([
                'message' => 'Kategori berhasil dibuat',
                'data' => $kategori
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal membuat kategori', 'message' => $e->getMessage()], 500);
        }
    }

    // GET /api/kategori/{id}
    public function show($id)
    {
        try {
            $kategori = Kategori::with('tipe')->findOrFail($id);
            return response()->json($kategori);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal mengambil detail kategori', 'message' => $e->getMessage()], 500);
        }
    }

    // PUT /api/kategori/{id}
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id_tipe' => 'required|exists:tipes,id',
                'nama' => 'nullable|string|max:255',
            ]);

            $kategori = Kategori::findOrFail($id);
            $kategori->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diperbarui',
                'data' => $kategori
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui kategori', 'message' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/kategori/{id}
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return response()->json(['message' => 'Kategori berhasil dihapus']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Gagal menghapus kategori', 'message' => $e->getMessage()], 500);
        }
    }
}
