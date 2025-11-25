<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReviewAlumni;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewAlumniSeeder extends Seeder
{
    public function run(): void
    {        
        DB::table('review_alumnis')->insert([
            [
                'id_user'   => 1, 
                'nama'      => 'Ratih Damayanti, S.Hut.M.Si.Ph.D',
                'angkatan'  => null,
                'profesi'   => 'Peneliti pada Kementerian Lingkungan Hidup dan Kehutanan',
                'review'    => 'Awalnya memilih Fakultas Kehutanan IPB karena selama SMA, saya aktif di organisasi pecinta alam. Saya masuk melalui jalur PMDK, dan memilih jurusan Teknologi Hasil Hutan karena melihat itu nama jurusan yang paling keren dan canggih, ada kata teknologinya ☺️ . Setelah masuk, saya semakin merasa beruntung, karena di THH saya menemukan diri saya. Dosen pengajarnya asyik dan selalu memotivasi membuat saya terus terpacu untuk mencari ilmu dan belajar. Saat memasuki dunia kerja, bekal yang diberikan pada pendidik membuat saya percaya diri, dan membuktikan bahwa lulusan THH IPB bisa berada di depan. Belajar di THH IPB tidak hanya identik dengan bekerja di lab mengutak-atik kayu, tapi ilmunya sangat luas dari hulu ke hilir, sehingga lulusan THH IPB bisa berkiprah dan memberikan manfaat di berbagai bidang. DTHH IPB, teruslah berkibar!!!',
                'foto'      => 'img/review1.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user'   => 1, 
                'nama'      => 'Arif Delviawan',
                'angkatan'  => '48',
                'profesi'   => null,
                'review'    => 'Dahulu kala saya mendapat ejekan luar biasa dari orang - orang, termasuk dari keluarga sendiri bahkan (bukan keluarga inti ya 😁) kenapa masuk kehutanan, jauh-jauh ke bogor buat jadi orang hutan, atau apalah itu. Tapi saya senyumin. Karena nyinyiran adalah doa kebaikan buat kita. ☺️ Itu yg diajarkan orang tua saya. Departemen Hasil Hutan IPB merupakan batu loncatan bagi saya untuk sampai ditahap ini. Jangan pernah menyerah dan pandai-pandailah untuk selalu bersyukur.',
                'foto'      => 'img/review2.jpeg', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user'   => 1, 
                'nama'      => 'Hanif Salahudin',
                'angkatan'  => '44',
                'profesi'   => null,
                'review'    => 'Terima kasih kepada Bapak / Ibu Dosen THH  (khususnya dosen pembimbing saya) untuk Ilmu dan Nilai Luhur yang saya dapatkan selama saya kuliah. Pesan untuk adik-adik yang saat ini kuliah, hormati dosen-dosenmu, jangan mengeluh. Banyak ilmu dan nilai-nilai penting yang baru kita sadari saat kita sudah lulus dan bekerja nanti',
                'foto'      => 'img/review3.jpg', 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // // Kalau user tidak ada, hentikan
        // $users = User::inRandomOrder()->take(14)->get();

        // if ($users->isEmpty()) {
        //     return;
        // }

        // foreach ($users as $user) {
        //     ReviewAlumni::create([
        //         'id_user'  => $user->id,
        //         'nama'     => $user->name ?? 'Nama Alumni',
        //         'angkatan' => '20' . rand(10, 25), // contoh 2010–2025
        //         'profesi'  => fake()->jobTitle(),
        //         'review'   => fake()->paragraph(3),
        //         'foto'     => $user->foto ?? 'uploads/reviewalumni/default.jpg',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
