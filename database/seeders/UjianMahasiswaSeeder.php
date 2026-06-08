<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Kolokiummhs;
use App\Models\Seminarmhs;
use App\Models\Komprehensifmhs;
use App\Models\StaffDept;
use App\Models\User;
use App\Models\Semester;
use App\Models\Ruangan;

class UjianMahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $dosenIds = StaffDept::pluck('id')->toArray();
        $semesterIds = Semester::pluck('id')->toArray();
        $ruanganIds = Ruangan::pluck('id')->toArray();

        /*
        --------------------------------------------------------------------------
        | AMBIL 100 MAHASISWA
        --------------------------------------------------------------------------
        */

        $mahasiswaKolokium = User::inRandomOrder()
            ->take(100)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TEMPLATE JUDUL
        |--------------------------------------------------------------------------
        */

        $tema = [
            'Machine Learning',
            'Artificial Intelligence',
            'Computer Vision',
            'Internet of Things',
            'UI/UX',
            'Data Mining',
            'Cyber Security',
            'Big Data',
        ];

        $objek = [
            'Sistem Akademik',
            'Monitoring Produksi',
            'Manajemen Gudang',
            'Evaluasi Pembelajaran',
            'Prediksi Penjualan',
            'Deteksi Kerusakan Kayu',
            'Administrasi Departemen',
        ];

        /*
        |--------------------------------------------------------------------------
        | FUNCTION DOSEN
        |--------------------------------------------------------------------------
        */

        $generateDosen = function () use ($faker, $dosenIds) {

            $p1 = $faker->randomElement($dosenIds);

            do {
                $p2 = $faker->randomElement($dosenIds);
            } while ($p1 == $p2);

            return [
                $p1,
                $p2,
                $faker->randomElement($dosenIds)
            ];
        };

        /*
        |--------------------------------------------------------------------------
        | 1. KOLOKIUM (100)
        |--------------------------------------------------------------------------
        */

        $kolokiumMahasiswaIds = [];

        foreach ($mahasiswaKolokium as $mhs) {

            [$p1, $p2, $komisi] = $generateDosen();

            $judul =
                'Pengembangan Sistem '
                . $faker->randomElement($tema)
                . ' untuk '
                . $faker->randomElement($objek);

            Kolokiummhs::create([
                'id_ruangan' => $faker->randomElement($ruanganIds),
                'id_mahasiswa' => $mhs->id,
                'id_semester' => $faker->randomElement($semesterIds),

                'id_pembimbing1' => $p1,
                'id_pembimbing2' => $p2,
                'id_komisipendidikan' => $komisi,

                'nama' => $mhs->nama,
                'nim' => $mhs->nim ?? 'G64'.$faker->numerify('######'),
                'alamat' => $faker->address(),

                'tanggal' => $faker->dateTimeBetween('-6 months', '-4 months'),

                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '10:00:00',

                'judul_kolokium' => $judul,

                'link_meeting' =>
                    'https://zoom.us/j/' .
                    $faker->numerify('##########'),

                'tipe_pelaksanaan' =>
                    $faker->randomElement([
                        'Online',
                        'Offline',
                        'Hybrid'
                    ]),
            ]);

            $kolokiumMahasiswaIds[] = [
                'mahasiswa' => $mhs,
                'judul' => $judul,
                'p1' => $p1,
                'p2' => $p2,
                'komisi' => $komisi,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 2. SEMINAR HASIL (50 DARI KOLOKIUM)
        |--------------------------------------------------------------------------
        */

        shuffle($kolokiumMahasiswaIds);

        $seminarData = array_slice($kolokiumMahasiswaIds, 0, 50);

        $seminarMahasiswaIds = [];

        foreach ($seminarData as $data) {

            Seminarmhs::create([
                'id_ruangan' => $faker->randomElement($ruanganIds),

                'id_mahasiswa' => $data['mahasiswa']->id,

                'id_semester' => $faker->randomElement($semesterIds),

                'id_pembimbing1' => $data['p1'],
                'id_pembimbing2' => $data['p2'],
                'id_komisipendidikan' => $data['komisi'],

                'nama' => $data['mahasiswa']->nama,

                'nim' =>
                    $data['mahasiswa']->nim
                    ?? 'G64'.$faker->numerify('######'),

                'alamat' => $faker->address(),
                
                'tanggal' => $faker->dateTimeBetween('-4 months', '-2 month'),

                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '11:00:00',

                'judul_seminar' => $data['judul'],

                'link_meeting' =>
                    'https://meet.google.com/' .
                    $faker->lexify('???-????-???'),

                'tipe_pelaksanaan' =>
                    $faker->randomElement([
                        'Online',
                        'Offline',
                        'Hybrid'
                    ]),
            ]);

            $seminarMahasiswaIds[] = $data;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. KOMPREHENSIF (20 DARI SEMINAR)
        |--------------------------------------------------------------------------
        */

        shuffle($seminarMahasiswaIds);

        $kompreData = array_slice($seminarMahasiswaIds, 0, 20);

        foreach ($kompreData as $data) {

            Komprehensifmhs::create([

                'id_mahasiswa' => $data['mahasiswa']->id,

                'id_semester' => $faker->randomElement($semesterIds),

                'id_pembimbing1' => $data['p1'],
                'id_pembimbing2' => $data['p2'],
                'id_komisipendidikan' => $data['komisi'],

                'nama' => $data['mahasiswa']->nama,

                'nim' =>
                    $data['mahasiswa']->nim
                    ?? 'G64'.$faker->numerify('######'),

                'alamat' => $faker->address(),
                
                'tanggal' => $faker->dateTimeBetween('-2 month', '-1 months'),

                'waktu_mulai' => '13:00:00',
                'waktu_selesai' => '15:00:00',

                'judul_tugasakhir' => $data['judul'],

                'skl' => $faker->randomElement([
                    'Ada',
                    'Belum Ada'
                ]),

                'tanggal_skl' => $faker->dateTimeBetween('-1 months', '2026-06-05'),

                'status' => $faker->randomElement([
                    'Pending',
                    'Disetujui',
                    'Selesai'
                ]),
            ]);
        }
    }
}
