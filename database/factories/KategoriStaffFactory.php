<?php

namespace Database\Factories;

use App\Models\KategoriStaff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KategoriStaff>
 */
class KategoriStaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word,
        ];
    }
}
