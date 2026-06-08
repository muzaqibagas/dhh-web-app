<?php

namespace Database\Seeders;

use App\Models\Seminarmhs;
use App\Models\StaffDept;
use App\Models\SyaratSeminarmhs;
use App\Models\User;
use Illuminate\Database\Seeder;

class SyaratSeminarmhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil mahasiswa yang sudah terdaftar di seminar
        $seminarMahasiswaIds = Seminarmhs::pluck('id_mahasiswa')->unique()->toArray();

        $mahasiswaList = User::whereIn('id', $seminarMahasiswaIds)->get();

        // Ambil staff untuk moderator dan penandatangan undangan
        $moderator = StaffDept::inRandomOrder()->first();
        $penandatangan = StaffDept::inRandomOrder()->first();

        foreach ($mahasiswaList as $mhs) {
            $randomDate = now()
                ->setMonth(10)
                ->setDay(rand(1, 31))
                ->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

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
                'status' => 'disetujui',
                'bap' => 'ditolak',

                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}
