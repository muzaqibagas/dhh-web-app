<?php

namespace Database\Factories;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\Factory;

class GaleriFactory extends Factory
{
    protected $model = Galeri::class;
    
    public function definition(): array
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_kategori' => \App\Models\Kategori::factory(),
            'judul' => $this->faker->sentence,
            'tanggal' => $this->faker->date(),
            'tipe' => $this->faker->randomElement(['gambar', 'video']),
            'video' => $this->faker->optional()->url,
            'gambar' => $this->faker->optional()->imageUrl(640, 480, 'galeri', true),            
        ];
    }
}
