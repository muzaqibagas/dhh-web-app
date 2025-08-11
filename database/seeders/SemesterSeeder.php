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
        \DB::table('Semesters')->insert([
            ['semester' => '1'],
            ['semester' => '2'],
            ['semester' => '3'],
            ['semester' => '4'],
            ['semester' => '5'],
            ['semester' => '6'],
            ['semester' => '7'],
            ['semester' => '8'],
        ]);
    }
}
