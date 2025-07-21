<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KolokiumTest extends TestCase
{
   use RefreshDatabase;

    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/kolokium');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/kolokium/create');
        $response->assertStatus(200);
    }

    public function test_store_kolokium(): void
    {
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();

        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-01',
            'waktu' => '10:00',            
            'judul_kolokium' => 'Kolokium Test',
        ];
        $response = $this->post('/kolokium', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('kolokiums', ['judul_kolokium' => 'Kolokium Test']);
    }

    public function test_show_kolokium(): void
    {
        $kolokium = \App\Models\Kolokium::factory()->create();
        $response = $this->get('/kolokium/' . $kolokium->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $kolokium = \App\Models\Kolokium::factory()->create();
        $response = $this->get('/kolokium/' . $kolokium->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_kolokium(): void
    {
        $kolokium = \App\Models\Kolokium::factory()->create();
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();
        
        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-02',
            'waktu' => '11:00',
            'tempat' => 'Ruang B',
            'judul_kolokium' => 'Kolokium Updated'
        ];
        $response = $this->put('/kolokium/' . $kolokium->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('kolokiums', ['judul_kolokium' => 'Kolokium Updated']);
    }

    public function test_destroy_kolokium(): void
    {
        $kolokium = \App\Models\Kolokium::factory()->create();
        $response = $this->delete('/kolokium/' . $kolokium->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('kolokiums', ['id' => $kolokium->id]);
    }
}
