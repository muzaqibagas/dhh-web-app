<?php
namespace Database\Factories;

use App\Models\Kolokium;
use App\Models\Ruangan;
use App\Models\User;
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
            'id_ruangan' => \App\Models\Ruangan::factory(),            
            'id_mahasiswa' => function () {
                return User::factory()->create(['role' => 'Mahasiswa'])->id;
            },
        ];
    }
}
