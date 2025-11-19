<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SyaratSeminarmhs;
use App\Models\User;
use App\Models\StaffDept;   

class SyaratSeminarmhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua mahasiswa yang ada
        $mahasiswaList = User::where('role', 'Mahasiswa')->get();

        // Ambil staff untuk moderator dan penandatangan undangan
        $moderator = StaffDept::inRandomOrder()->first();
        $penandatangan = StaffDept::inRandomOrder()->first();

        foreach ($mahasiswaList as $mhs) {
            SyaratSeminarmhs::create([
                'id_mahasiswa' => $mhs->id,
                'id_moderator' => $moderator?->id, // boleh null
                'id_penandatanganundangan' => $penandatangan?->id, // boleh null

                // Upload file dummy
                'formulir' => 'uploads/syarat/formulir_dummy.pdf',
                'makalah' => 'uploads/syarat/makalah_dummy.pdf',
                'bukti_sks' => 'uploads/syarat/bukti_sks_dummy.pdf',
                'bukti_spp' => 'uploads/syarat/bukti_spp_dummy.pdf',
                'bukti_kehadiran' => 'uploads/syarat/bukti_kehadiran_dummy.pdf',

                // Alasan kosong
                'alasan_formulir' => null,
                'alasan_makalah' => null,
                'alasan_bukti_sks' => null,
                'alasan_bukti_spp' => null,
                'alasan_bukti_kehadiran' => null,

                // Status awal
                'status' => 'pending',  
                'bap' => 'belum_melaksanakan',

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
