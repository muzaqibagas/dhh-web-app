<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReviewAlumni;
use App\Models\User;

class ReviewAlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Kalau user tidak ada, hentikan
        $users = User::inRandomOrder()->take(14)->get();

        if ($users->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            ReviewAlumni::create([
                'id_user'  => $user->id,
                'nama'     => $user->name ?? 'Nama Alumni',
                'angkatan' => '20' . rand(10, 25), // contoh 2010–2025
                'profesi'  => fake()->jobTitle(),
                'review'   => fake()->paragraph(3),
                'foto'     => $user->foto ?? 'uploads/reviewalumni/default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
