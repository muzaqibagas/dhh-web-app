<?php

namespace Tests\Feature;

use App\Models\Divisi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DivisiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed()
    {
        $response = $this->get('/divisi');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed()
    {
        $response = $this->get('/divisi/create');
        $response->assertStatus(200);
    }

    public function test_store_divisi()
    {
        $data = [
            'nama' => 'Divisi Test',
        ];
        $response = $this->post('/divisi', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('divisis', ['nama' => 'Divisi Test']);
    }

    public function test_show_divisi()
    {
        $divisi = Divisi::factory()->create();
        $response = $this->get('/divisi/'.$divisi->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed()
    {
        $divisi = Divisi::factory()->create();
        $response = $this->get('/divisi/'.$divisi->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update_divisi()
    {
        $divisi = Divisi::factory()->create();
        $data = ['nama' => 'Divisi Updated'];
        $response = $this->put('/divisi/'.$divisi->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('divisis', ['nama' => 'Divisi Updated']);
    }

    public function test_destroy_divisi()
    {
        $divisi = Divisi::factory()->create();
        $response = $this->delete('/divisi/'.$divisi->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('divisis', ['id' => $divisi->id]);
    }
}
