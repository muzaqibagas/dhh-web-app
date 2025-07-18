<?php
namespace Database\Factories;

use App\Models\Tipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipeFactory extends Factory
{
    protected $model = Tipe::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word,
        ];
    }
}
