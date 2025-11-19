<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use App\Models\User;
use App\Models\KategoriArtikel;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'Admin')->first();
        $kategoris = KategoriArtikel::all();

        if (!$admin || $kategoris->isEmpty()) {
            return;
        }

        foreach ($kategoris as $kat) {

            Artikel::create([
                'id_user' => $admin->id, // hanya admin
                'id_kategoriartikel' => $kat->id,
                'foto' => $admin->foto ?? 'uploads/artikel/foto_dummy.jpg', // jika admin tidak punya foto
                'judul' => "Contoh Artikel {$kat->nama}",
                'tanggal' => now()->format('Y-m-d'),
                'deskripsi' => "Ini adalah deskripsi dummy untuk artikel kategori {$kat->nama}.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
