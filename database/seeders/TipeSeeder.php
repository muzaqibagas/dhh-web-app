<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipes')->insert([
            ['nama' => 'matakuliah'],
            ['nama' => 'galeri'],
            ['nama' => 'staffdept'],
            ['nama' => 'artikel'],
        ]);
    }
}
