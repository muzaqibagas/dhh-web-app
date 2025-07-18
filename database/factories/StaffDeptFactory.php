<?php
namespace Database\Factories;

use App\Models\StaffDept;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffDeptFactory extends Factory
{
    protected $model = StaffDept::class;

    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_kategori' => \App\Models\Kategori::factory(),
            'id_divisi' => \App\Models\Divisi::factory(),
            'foto' => $this->faker->imageUrl(),
            'nama' => $this->faker->name(),
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'nip' => $this->faker->unique()->numerify('1970#######'),
            'jabatan' => $this->faker->jobTitle(),
            'email' => $this->faker->unique()->safeEmail(),
            'keahlian' => $this->faker->sentence(),
            'sinta' => $this->faker->url(),
            'google_scholar' => $this->faker->url(),
            'scopus' => $this->faker->url(),
            'researchgate' => $this->faker->url(),
            'website' => $this->faker->url(),
            'minat_penelitian' => $this->faker->paragraph(),
            'riwayat_pendidikan' => $this->faker->paragraph(),
        ];
    }
}
