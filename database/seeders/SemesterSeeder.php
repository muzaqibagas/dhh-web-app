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
            '1', '2', '3', '4',
            '5', '6', '7', '8',
        ];

        foreach ($semesters as $semester) {
            DB::table('semesters')->insert([                
                'tingkat_semester' => $semester,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
