<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Mitra;
use App\Models\ReviewAlumni;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $featured = Artikel::latest()->first();
        $artikels = Artikel::latest()->skip(1)->take(4)->get();
        $galeri = Galeri::where('tipe', 'gambar')->latest()->take(10)->get();
        $reviewAlumni = ReviewAlumni::latest()->take(3)->get();
        $mitra = Mitra::all();

        return view('user.home', compact('featured', 'artikels', 'galeri', 'reviewAlumni', 'mitra'));
    }

    public function file()
    {
        return view('user.file');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        // Pastikan user yang login hanya bisa edit profilnya sendiri
        if (auth()->id() !== $user->id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Arahkan ke halaman edit sesuai role
        if ($user->role === 'Admin') {
            return view('admprofile.edit', compact('user'));
        } elseif ($user->role === 'Mahasiswa') {
            return view('profilemhs.edit', compact('user'));
        } else {
            abort(404, 'Role tidak dikenali.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'nim' => 'nullable|string|unique:users,nim,'.$id,
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'nullable|in:Admin,Mahasiswa',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'tanda_tangan' => 'nullable|string',
        ]);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($user->foto && file_exists(public_path('profile/'.$user->foto))) {
                unlink(public_path('profile/'.$user->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_foto.'.$file->getClientOriginalExtension();
            $file->move(public_path('profile'), $filename);
            $data['foto'] = $filename;
        }

        // Handle tanda tangan
        if ($request->hasFile('tanda_tangan_img')) {
            // Hapus tanda tangan lama kalau ada
            if ($user->tanda_tangan && file_exists(public_path('signature/'.$user->tanda_tangan))) {
                unlink(public_path('signature/'.$user->tanda_tangan));
            }

            // Simpan file upload
            $file = $request->file('tanda_tangan_img');
            $filename = time().'_ttd.'.$file->getClientOriginalExtension();
            $file->move(public_path('signature'), $filename);
            $data['tanda_tangan'] = $filename;

        } elseif ($request->filled('tanda_tangan')) {
            // Hapus tanda tangan lama kalau ada
            if ($user->tanda_tangan && file_exists(public_path('signature/'.$user->tanda_tangan))) {
                unlink(public_path('signature/'.$user->tanda_tangan));
            }

            // Simpan dari canvas (base64)
            $image = $request->input('tanda_tangan'); // <-- ambil dari request dulu
            if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
                $image = substr($image, strpos($image, ',') + 1);
                $image = str_replace(' ', '+', $image);
                $ext = strtolower($type[1]) === 'jpeg' ? 'jpg' : $type[1];
                $imageName = time().'_canvas.'.$ext;
                \File::put(public_path('signature/'.$imageName), base64_decode($image));
                $data['tanda_tangan'] = $imageName;
            }
        } else {
            unset($data['tanda_tangan']);
        }

        $user->update($data);

        if ($user->role === 'Admin') {
            return redirect()->route('admprofile.index')->with('success', 'Profil Admin berhasil diperbarui!');
        } elseif ($user->role === 'Mahasiswa') {
            return redirect()->route('profilemhs.index')->with('success', 'Profil Mahasiswa berhasil diperbarui!');
        } else {
            abort(404, 'Role tidak dikenali.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
