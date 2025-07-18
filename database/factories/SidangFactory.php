<?php
namespace Database\Factories;

use App\Models\Sidang;
use Illuminate\Database\Eloquent\Factories\Factory;

class SidangFactory extends Factory
{
    protected $model = Sidang::class;

    public function definition()
    {
        return [
            'judul_tugasakhir' => $this->faker->sentence(3),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
            'tempat' => $this->faker->word,
            'id_ruangan' => \App\Models\Ruangan::factory(),
            // tambahkan field lain sesuai kebutuhan
        ];
    }
}
