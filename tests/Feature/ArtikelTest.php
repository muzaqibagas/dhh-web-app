<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artikel;

class ArtikelTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed()
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed()
    {
        $response = $this->get('/artikel/create');
        $response->assertStatus(200);
    }

    public function test_store_artikel()
    {
        $data = [
            'judul' => 'Artikel Test',
        ];
        $response = $this->post('/artikel', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('artikels', ['judul' => 'Artikel Test']);
    }

    public function test_show_artikel()
    {
        $artikel = Artikel::factory()->create();
        $response = $this->get('/artikel/' . $artikel->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed()
    {
        $artikel = Artikel::factory()->create();
        $response = $this->get('/artikel/' . $artikel->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_artikel()
    {
        $artikel = Artikel::factory()->create();
        $data = ['judul' => 'Artikel Updated'];
        $response = $this->put('/artikel/' . $artikel->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('artikels', ['judul' => 'Artikel Updated']);
    }

    public function test_destroy_artikel()
    {
        $artikel = Artikel::factory()->create();
        $response = $this->delete('/artikel/' . $artikel->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('artikels', ['id' => $artikel->id]);
    }
}
