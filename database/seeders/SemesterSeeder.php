<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            'semester1', 'semester2', 'semester3', 'semester4',
            'semester5', 'semester6', 'semester7', 'semester8',
        ];

        foreach ($semesters as $semester) {
            DB::table('semesters')->insert([
                'id_kurikulum' => 1,
                'tingkat_semester' => $semester,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
