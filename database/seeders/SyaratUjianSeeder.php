<?php

namespace Database\Seeders;

use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Ruangan;
use App\Models\Seminarmhs;
use App\Models\StaffDept;
use App\Models\SyaratUjian;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SyaratUjianSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $ruanganNames = Ruangan::pluck('nama')->toArray();
        $moderatorIds = StaffDept::pluck('id')->toArray();
        $pengujiIds = StaffDept::pluck('id')->toArray();
        $penandatanganIds = StaffDept::pluck('id')->toArray();

        $sourceData = [
            'kolokium' => Kolokiummhs::pluck('id_mahasiswa')->unique()->toArray(),
            'seminar' => Seminarmhs::pluck('id_mahasiswa')->unique()->toArray(),
            'komprehensif' => Komprehensifmhs::pluck('id_mahasiswa')->unique()->toArray(),
        ];

        foreach ($sourceData as $jenis => $mahasiswaIds) {
            foreach (array_values(array_unique($mahasiswaIds)) as $id_mahasiswa) {
                $status = $this->randomStatus($faker);
                $bap = $this->statusToBap($status, $faker);
                $randomDate = $this->randomDateJanToJun($faker);
                $reasons = $this->buildReasons($status, $faker);

                SyaratUjian::create([
                    'id_mahasiswa' => $id_mahasiswa,
                    'id_moderator' => $this->tambahModerator($moderatorIds, $faker),
                    'id_penguji' => $this->tambahPenguji($jenis, $pengujiIds, $faker),
                    'id_penandatanganundangan' => $faker->randomElement($penandatanganIds) ?: null,
                    'jenis_ujian' => $jenis,
                    'ruangan' => $faker->randomElement($ruanganNames) ?: 'Ruang ' . $faker->numberBetween(101, 305),
                    'formulir' => 'uploads/syarat/formulir_dummy.pdf',
                    'alasan_formulir' => $reasons['alasan_formulir'],
                    'makalah' => 'uploads/syarat/makalah_dummy.pdf',
                    'alasan_makalah' => $reasons['alasan_makalah'],
                    'bukti_sks' => 'uploads/syarat/bukti_sks_dummy.pdf',
                    'alasan_bukti_sks' => $reasons['alasan_bukti_sks'],
                    'bukti_spp' => 'uploads/syarat/bukti_spp_dummy.pdf',
                    'alasan_bukti_spp' => $reasons['alasan_bukti_spp'],
                    'bukti_kehadiran' => 'uploads/syarat/bukti_kehadiran_dummy.pdf',
                    'alasan_bukti_kehadiran' => $reasons['alasan_bukti_kehadiran'],
                    'status' => $status,
                    'bap' => $bap,
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate->copy()->addHours(rand(1, 72)),
                ]);
            }
        }
    }

    private function randomStatus($faker): string
    {
        $roll = $faker->numberBetween(1, 100);

        if ($roll <= 65) {
            return 'disetujui';
        }

        if ($roll <= 85) {
            return 'pending';
        }

        return 'ditolak';
    }

    private function statusToBap(string $status, $faker): string
    {
        return match ($status) {
            'disetujui' => $faker->boolean(70) ? 'diterima' : 'belum_melaksanakan',
            'pending' => 'belum_melaksanakan',
            'ditolak' => 'ditolak',
            default => 'belum_melaksanakan',
        };
    }

    private function buildReasons(string $status, $faker): array
    {
        $reasons = [
            'alasan_formulir' => null,
            'alasan_makalah' => null,
            'alasan_bukti_sks' => null,
            'alasan_bukti_spp' => null,
            'alasan_bukti_kehadiran' => null,
        ];

        if ($status !== 'ditolak') {
            return $reasons;
        }

        $fields = array_keys($reasons);
        $selected = $faker->randomElements($fields, rand(1, 3));

        foreach ($selected as $field) {
            $reasons[$field] = $faker->sentence(8);
        }

        return $reasons;
    }

    private function tambahModerator(array $moderatorIds, $faker): ?int
    {
        return $faker->randomElement($moderatorIds) ?: null;
    }

    private function tambahPenguji(string $jenis, array $pengujiIds, $faker): ?int
    {
        if ($jenis !== 'komprehensif') {
            return null;
        }

        return $faker->randomElement($pengujiIds) ?: null;
    }

    private function randomDateJanToJun($faker): Carbon
    {
        $year = now()->year;
        $month = $faker->numberBetween(1, 6);
        $day = $faker->numberBetween(1, Carbon::create($year, $month)->daysInMonth);

        return Carbon::create($year, $month, $day, $faker->numberBetween(8, 16), $faker->numberBetween(0, 59), $faker->numberBetween(0, 59));
    }
}
