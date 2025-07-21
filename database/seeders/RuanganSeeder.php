<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangans = ['ABT1', 'ABT2', 'SK214', 'SK224', 'SK227'];

        foreach ($ruangans as $ruangan) {
            DB::table('ruangans')->insert([                
                'nama' => $ruangan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }        
    }
}
