<?php

namespace Database\Factories;

use App\Models\Jenjang;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenjangFactory extends Factory
{
    protected $model = Jenjang::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word,
        ];
    }
}
