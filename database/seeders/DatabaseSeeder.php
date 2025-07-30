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
            kategoriKompetensiSeeder::class,
            kurikulumDetailSeeder::class,
            UserSeeder::class,            
            KurikulumSeeder::class,
            SemesterSeeder::class,             
            DivisiSeeder::class,    
            TipeSeeder::class,                 
            KategoriSeeder::class,           
            RuanganSeeder::class,  
            KategoriStaffSeeder::class,            
        ]);
    }
}
