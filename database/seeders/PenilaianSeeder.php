<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use App\Models\Rubrik;
use App\Models\SyaratUjian;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $rubriksByJenis = Rubrik::all()->groupBy('jenis_sidang');
        Penilaian::truncate();

        $syaratByMahasiswa = SyaratUjian::with(['kolokiummhs', 'seminarmhs', 'komprehensifmhs'])
            ->get()
            ->groupBy('id_mahasiswa');

        foreach ($syaratByMahasiswa as $mahasiswaId => $syarats) {
            $kompre = $syarats->firstWhere('jenis_ujian', 'komprehensif');
            $seminar = $syarats->firstWhere('jenis_ujian', 'seminar');
            $kolokium = $syarats->firstWhere('jenis_ujian', 'kolokium');

            if ($kompre && $kompre->bap === 'diterima') {
                $this->seedStage($kolokium, $rubriksByJenis, $faker);
                $this->seedStage($seminar, $rubriksByJenis, $faker);
                $this->seedStage($kompre, $rubriksByJenis, $faker);
                continue;
            }

            if ($seminar && $seminar->bap === 'diterima') {
                $this->seedStage($kolokium, $rubriksByJenis, $faker);
                $this->seedStage($seminar, $rubriksByJenis, $faker);
                continue;
            }

            if ($kolokium && $kolokium->bap === 'diterima') {
                $this->seedStage($kolokium, $rubriksByJenis, $faker);
            }
        }
    }

    private function seedStage(?SyaratUjian $syarat, $rubriksByJenis, $faker): void
    {
        if (! $syarat) {
            return;
        }

        $jenis = $syarat->jenis_ujian;
        $rubriks = $rubriksByJenis[$jenis] ?? null;
        if (! $rubriks || $rubriks->isEmpty()) {
            return;
        }

        $sidang = match ($jenis) {
            'kolokium' => $syarat->kolokiummhs,
            'seminar' => $syarat->seminarmhs,
            'komprehensif' => $syarat->komprehensifmhs,
            default => null,
        };

        if (! $sidang) {
            return;
        }

        $evaluators = collect();
        if ($syarat->id_moderator) {
            $evaluators->push([
                'field' => 'id_moderator',
                'user_id' => $syarat->id_moderator,
            ]);
        }
        if (! empty($sidang->id_pembimbing1)) {
            $evaluators->push([
                'field' => 'id_pembimbing1',
                'user_id' => $sidang->id_pembimbing1,
            ]);
        }
        if (! empty($sidang->id_pembimbing2)) {
            $evaluators->push([
                'field' => 'id_pembimbing2',
                'user_id' => $sidang->id_pembimbing2,
            ]);
        }
        if ($jenis === 'komprehensif' && ! empty($syarat->id_penguji)) {
            $evaluators->push([
                'field' => 'id_penguji',
                'user_id' => $syarat->id_penguji,
            ]);
        }

        $evaluators = $evaluators->unique(function ($item) {
            return $item['field'].'_'.$item['user_id'];
        })->values();
        if ($evaluators->isEmpty()) {
            return;
        }

        foreach ($evaluators as $evaluator) {
            $nilaiAkhir = 0;
            $rows = [];

            foreach ($rubriks as $rubrik) {
                $nilai = $faker->randomElement(['2', '3', '4']);
                $score = ($nilai / 4) * $rubrik->bobot;
                $nilaiAkhir += $score;

                $rows[] = [
                    'id_syarat_ujian' => $syarat->id,
                    $evaluator['field'] => $evaluator['user_id'],
                    'id_rubrik' => $rubrik->id,
                    'nilai' => $nilai,
                    'score' => $score,
                    'nilai_akhir' => null,
                    'catatan' => $faker->sentence(10),
                    'created_at' => $syarat->created_at ?? Carbon::now(),
                    'updated_at' => $syarat->created_at?->copy()->addMinutes(5) ?? Carbon::now(),
                ];
            }

            foreach ($rows as $row) {
                Penilaian::create(array_merge($row, ['nilai_akhir' => $nilaiAkhir]));
            }
        }
    }
}
