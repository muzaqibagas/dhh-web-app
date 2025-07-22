<?php
namespace Database\Factories;

use App\Models\Sidang;
use App\Models\Ruangan;
use App\Models\User;
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
            'id_ruangan' => \App\Models\Ruangan::factory(),
            'id_mahasiswa' => function () {
                return User::factory()->create(['role' => 'Mahasiswa'])->id;
            },
        ];
    }
}
