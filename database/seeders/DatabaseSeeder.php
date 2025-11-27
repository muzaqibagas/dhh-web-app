<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            JenjangSeeder::class,                        
            UserSeeder::class,                                         
            DivisiSeeder::class,                
            RuanganSeeder::class,  
            KategoriStaffSeeder::class,   
            SemesterSeeder::class,
            StaffDeptSeeder::class,     
            KategoriGaleriSeeder::class,            
            GaleriSeeder::class, 
            KategoriArtikelSeeder::class,
            SdgsSeeder::class,
            ArtikelSeeder::class,
            kontenDeptSeeder::class,
            kontenJenjangSeeder::class,
            LeafletJenjangSeeder::class,
            MitraSeeder::class,            
            ketuaDHHSSeeder::class,            
            ReviewAlumniSeeder::class,
            // SyaratKolokiummhsSeeder::class,
            // SyaratSeminarmhsSeeder::class,
            // SyaratKomprehensifmhsSeeder::class,            

            // seederbuatan 
            // 1. Syaratkolokiummhs
            // 2. Syaratseminarmhs
            // 3. Syaratkomprehensifmhs
            // 4. kategori galeri, kategori galeri jadi dosen dan mahasiswa saja
            // 5. Galeri
            // 6. kategori artikel, kategori artikel jadi dosen dan mahasiswa saja                   
            // 7. Artikel
            // 8. Review Alumni
            // 9. Mitra
            // 10. KategoriStaff
            // 11. Ketua DHH
        ]);
    }
}