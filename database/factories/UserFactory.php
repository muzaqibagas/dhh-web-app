<?php

namespace Database\Factories;

use App\Models\Jenjang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_jenjang' => Jenjang::factory(),
            'nim' => fake()->unique()->numerify('20####'),
            'nama' => fake()->name(),
            'no_hp' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'tanggal_lahir' => fake()->date('Y-m-d'),
            'angkatan' => fake()->year(),
            'status' => fake()->randomElement(['Aktif', 'Cuti', 'Lulus']),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'role' => fake()->randomElement(['Admin', 'Mahasiswa']),
            'foto' => fake()->imageUrl(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
