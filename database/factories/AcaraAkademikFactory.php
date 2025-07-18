<?php
namespace Database\Factories;

use App\Models\AcaraAkademik;
use App\Models\User;
use App\Models\StaffDept;
use App\Models\Kolokium;
use App\Models\Seminar;
use App\Models\Sidang;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcaraAkademikFactory extends Factory
{
    protected $model = AcaraAkademik::class;

    public function definition()
    {
        return [
            'id_mahasiswa' => User::factory(),
            'id_staffdept' => StaffDept::factory(),
            'id_kolokium' => Kolokium::factory(),
            'id_seminar' => Seminar::factory(),
            'id_sidang' => Sidang::factory(),
        ];
    }
}
