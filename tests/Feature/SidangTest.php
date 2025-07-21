<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SidangTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/sidang');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/sidang/create');
        $response->assertStatus(200);
    }

    public function test_store_sidang(): void
    {
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();

        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-01',
            'waktu' => '10:00',            
            'judul_tugasakhir' => 'Sidang Test',
        ];
        $response = $this->post('/sidang', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('sidangs', ['judul_tugasakhir' => 'Sidang Test']);
    }

    public function test_show_sidang(): void
    {
        $sidang = \App\Models\Sidang::factory()->create();
        $response = $this->get('/sidang/' . $sidang->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $sidang = \App\Models\Sidang::factory()->create();
        $response = $this->get('/sidang/' . $sidang->id . '/edit');
        $response->assertStatus(200);
    }
    
    public function test_update_sidang(): void
    {
        $sidang = \App\Models\Sidang::factory()->create();
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();

        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-02',
            'waktu' => '11:00',            
            'judul_tugasakhir' => 'Sidang Updated',
        ];
        $response = $this->put('/sidang/' . $sidang->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('sidangs', ['judul_tugasakhir' => 'Sidang Updated']);
    }

    public function test_delete_sidang(): void
    {
        $sidang = \App\Models\Sidang::factory()->create();
        $response = $this->delete('/sidang/' . $sidang->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('sidangs', ['id' => $sidang->id]);
    }
}
