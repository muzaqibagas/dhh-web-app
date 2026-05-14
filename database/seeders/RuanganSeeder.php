<?php

namespace Database\Seeders;

use App\Models\JenisRuangan;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruanganList = [
            'ABT1' => ['kolokium', 'seminar'],
            'ABT2' => ['kolokium', 'seminar'],
            'SK214' => ['komprehensif'],
            'SK224' => ['komprehensif'],
            'SK227' => ['komprehensif'],
        ];

        foreach ($ruanganList as $nama => $jenisList) {
            $ruangan = Ruangan::create(['nama' => $nama]);

            foreach ($jenisList as $jenis) {
                JenisRuangan::create([
                    'ruangan_id' => $ruangan->id,
                    'jenis' => $jenis,
                ]);
            }
        }
    }
}
