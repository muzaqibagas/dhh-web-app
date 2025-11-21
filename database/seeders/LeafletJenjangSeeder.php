<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeafletJenjangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leaflet_jenjangs')->insert([
            [
                'id_kontenjenjang' => 1, // id konten S1
                'gambar' => 'img/leaflet1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kontenjenjang' => 1, // id konten S1
                'gambar' => 'img/leaflet2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
