<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kurikulums')->insert([
            'id' => 1, // Sesuai kebutuhan relasi semester                                    
            'nama' => 'Kurikulum Fahutan',
            'tahun' => 2025,           
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
