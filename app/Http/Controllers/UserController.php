<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jenjang' => 'nullable|exists:jenjangs,id',
            'nim' => 'required|string|unique:users,nim',
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'angkatan' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|in:Admin,Mahasiswa',
            'foto' => 'nullable|string|max:255',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'Mahasiswa'; 
            
        $insert = \App\Models\User::create($data);
        if ($insert)
            return redirect()->route('user.index')->with('success', 'Data berhasil disimpan!');
        else
            return back()->with('error', 'Gagal menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('user.show', compact('user'));
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
        $user = \App\Models\User::findOrFail($id);

        $data = $request->validate([
            'id_jenjang' => 'nullable|exists:jenjangs,id',
            'nim' => 'nullable|string|unique:users,nim,' . $id,
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'angkatan' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'nullable|in:Admin,Mahasiswa',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile'), $filename);
            $data['foto'] = $filename;
        }

        $update = $user->update($data);

        if ($update)
            if ($user->role === 'Admin') {
                return redirect()->route('admprofile.index')->with('success', 'Profil Admin berhasil diperbarui!');
            } elseif ($user->role === 'Mahasiswa') {
                return redirect()->route('profilemhs.index')->with('success', 'Profil Mahasiswa berhasil diperbarui!');                
            } else {
                abort(404, 'Role tidak dikenali.');
            }
        else
            return back()->with('error', 'Gagal memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
