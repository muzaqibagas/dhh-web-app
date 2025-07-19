<?php
namespace Database\Factories;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtikelFactory extends Factory
{
    protected $model = Artikel::class;

    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_kategori' => \App\Models\Kategori::factory(),
            'foto' => $this->faker->imageUrl(640, 480, 'artikel', true),
            'judul' => $this->faker->sentence(6),
            'tanggal' => $this->faker->date(),
            'deskripsi' => $this->faker->paragraph(3),
        ];
    }
}
