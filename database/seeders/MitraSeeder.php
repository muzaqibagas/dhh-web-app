<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MitraSeeder extends Seeder
{
    public function run()
    {
        DB::table('mitras')->insert([
            [
                'id_user' => 1,
                'nama' => 'BRIN',
                'foto' => 'img/mitra1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'PT Iida Group Holdings',
                'foto' => 'img/mitra2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'PT Nose',
                'foto' => 'img/mitra3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'ISWA',
                'foto' => 'img/mitra4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'ILWA',
                'foto' => 'img/mitra5.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'Mapeki',
                'foto' => 'img/mitra6.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'IFPF',
                'foto' => 'img/mitra7.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'Universite de Lorraine',
                'foto' => 'img/mitra8.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'Tokyo University',
                'foto' => 'img/mitra9.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 1,
                'nama' => 'PT PWKWI (Prima Wana Kreasi Wood Industry)',
                'foto' => 'img/mitra10.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
