<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use App\Models\User;
use App\Models\KategoriGaleri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil admin
        $admin = User::where('role', 'Admin')->first();
        $kategoris = KategoriGaleri::all();

        if (!$admin || $kategoris->isEmpty()) {
            return;
        }

        foreach ($kategoris as $kat) {

            // Random tipe
            $tipe = rand(0, 1) ? 'gambar' : 'video';

            Galeri::create([
                'id_user' => $admin->id, // hanya admin
                'id_kategorigaleri' => $kat->id,
                'judul' => "Contoh Galeri {$kat->nama}",
                'tanggal' => now()->format('Y-m-d'),
                'tipe' => $tipe,
                'video' => $tipe == 'video' ? 'uploads/galeri/video_dummy.mp4' : null,
                'gambar' => $tipe == 'gambar' ? 'uploads/galeri/gambar_dummy.jpg' : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
