<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RuanganTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/ruangan');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/ruangan/create');
        $response->assertStatus(200);
    }

    public function test_store_ruangan(): void
    {
        $data = [
            'nama' => 'Ruangan Test',
        ];
        $response = $this->post('/ruangan', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('ruangans', ['nama' => 'Ruangan Test']);
    }

    public function test_show_ruangan(): void
    {
        $ruangan = \App\Models\Ruangan::factory()->create();
        $response = $this->get('/ruangan/' . $ruangan->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $ruangan = \App\Models\Ruangan::factory()->create();
        $response = $this->get('/ruangan/' . $ruangan->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_ruangan(): void
    {
        $ruangan = \App\Models\Ruangan::factory()->create();
        $data = [
            'nama' => 'Ruangan Updated'
        ];
        $response = $this->put('/ruangan/' . $ruangan->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('ruangans', ['nama' => 'Ruangan Updated']);
    }

    public function test_destroy_ruangan(): void
    {
        $ruangan = \App\Models\Ruangan::factory()->create();
        $response = $this->delete('/ruangan/' . $ruangan->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('ruangans', ['id' => $ruangan->id]);
    }
}
