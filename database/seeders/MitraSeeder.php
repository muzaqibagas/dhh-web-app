<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\User;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user admin
        $admin = User::where('role', 'Admin')->first();

        if (!$admin) {
            return;
        }

        // Buat 10 data dummy untuk mitra
        for ($i = 1; $i <= 12; $i++) {
            Mitra::create([
                'id_user' => $admin->id,
                'nama' => "Mitra Kerja Sama {$i}",
                'foto' => "uploads/mitra/mitra_dummy.png",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

