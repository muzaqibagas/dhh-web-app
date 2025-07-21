<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeminarTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/seminar');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/seminar/create');
        $response->assertStatus(200);
    }

    public function test_store_seminar(): void
    {
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();

        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-01',
            'waktu' => '10:00',            
            'judul_seminar' => 'Seminar Test',
        ];
        $response = $this->post('/seminar', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('seminars', ['judul_seminar' => 'Seminar Test']);
    }

    public function test_show_seminar(): void
    {
        $seminar = \App\Models\Seminar::factory()->create();
        $response = $this->get('/seminar/' . $seminar->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $seminar = \App\Models\Seminar::factory()->create();
        $response = $this->get('/seminar/' . $seminar->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_seminar(): void
    {
        $seminar = \App\Models\Seminar::factory()->create();
        $mahasiswa = \App\Models\User::factory()->create(); 
        $ruangan = \App\Models\Ruangan::factory()->create();

        $data = [
            'id_ruangan' => $ruangan->id,
            'id_mahasiswa' => $mahasiswa->id, 
            'tanggal' => '2023-10-01',
            'waktu' => '10:00',            
            'judul_seminar' => 'Updated Seminar Test',
        ];
        $response = $this->put('/seminar/' . $seminar->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('seminars', ['judul_seminar' => 'Updated Seminar Test']);
    }

    public function test_delete_seminar(): void
    {
        $seminar = \App\Models\Seminar::factory()->create();
        $response = $this->delete('/seminar/' . $seminar->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('seminars', ['id' => $seminar->id]);
    }
}
