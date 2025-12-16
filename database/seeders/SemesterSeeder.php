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
        \DB::table('semesters')->insert([
            ['semester' => '7'],
            ['semester' => '8'],
            ['semester' => '9'],
            ['semester' => '10'],
            ['semester' => '11'],
            ['semester' => '12'],
            ['semester' => '13'],
            ['semester' => '14'],
        ]);
    }
}
