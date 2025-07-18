<?php
namespace Database\Factories;

use App\Models\Seminar;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeminarFactory extends Factory
{
    protected $model = Seminar::class;

    public function definition()
    {
        return [
            'judul_seminar' => $this->faker->sentence(3),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
            'tempat' => $this->faker->word,
            'id_ruangan' => \App\Models\Ruangan::factory(),
            // tambahkan field lain sesuai kebutuhan
        ];
    }
}
