<?php
namespace Database\Factories;

use App\Models\Kolokium;
use Illuminate\Database\Eloquent\Factories\Factory;

class KolokiumFactory extends Factory
{
    protected $model = Kolokium::class;

    public function definition()
    {
        return [
            'judul_kolokium' => $this->faker->sentence(3),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
            'tempat' => $this->faker->word,
            'id_ruangan' => \App\Models\Ruangan::factory(),
            // tambahkan field lain sesuai kebutuhan
        ];
    }
}
