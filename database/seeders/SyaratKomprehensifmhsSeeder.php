<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SyaratKomprehensifmhs;
use App\Models\User;
use App\Models\StaffDept;   

class SyaratKomprehensifmhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua mahasiswa yang ada
        $mahasiswaList = User::where('role', 'Mahasiswa')->get();

        // Ambil random staff untuk moderator, penguji, dan penandatangan
        $moderator = StaffDept::inRandomOrder()->first();
        $penguji = StaffDept::inRandomOrder()->first();
        $penandatangan = StaffDept::inRandomOrder()->first();

        foreach ($mahasiswaList as $mhs) {
            SyaratKomprehensifmhs::create([
                'id_mahasiswa' => $mhs->id,
                'id_moderator' => $moderator?->id,
                'id_penguji' => $penguji?->id,
                'id_penandatanganundangan' => $penandatangan?->id,

                // File dummy
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