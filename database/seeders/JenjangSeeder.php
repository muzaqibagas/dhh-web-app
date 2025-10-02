<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenjangs = ['S1', 'S2', 'S3'];

        foreach ($jenjangs as $nama) {
            DB::table('jenjangs')->insert([
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}