<?php
namespace Database\Factories;

use App\Models\Seminar;
use App\Models\Ruangan;
use App\Models\User;
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
            'id_ruangan' => \App\Models\Ruangan::factory(),            
            'id_mahasiswa' => function () {
                return User::factory()->create(['role' => 'Mahasiswa'])->id;
            },
        ];
    }
}
