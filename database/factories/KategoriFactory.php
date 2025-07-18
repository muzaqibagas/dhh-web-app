<?php
namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    public function definition()
    {
        return [
            'id_tipe' => \App\Models\Tipe::factory(),
            'nama' => $this->faker->word,
        ];
    }
}
