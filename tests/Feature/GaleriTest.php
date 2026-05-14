<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GaleriTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed()
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed()
    {
        $response = $this->get('/galeri/create');
        $response->assertStatus(200);
    }

    public function test_store_galeri()
    {
        $user = User::factory()->create();
        $kategori = Kategori::factory()->create();
        $data = [
            'id_user' => $user->id,
            'id_kategori' => $kategori->id,
            'judul' => 'Galeri Test',
            'tanggal' => now()->toDateString(),
            'tipe' => 'gambar',
            'video' => null,
            'gambar' => 'gambar.jpg',
            'deskripsi' => 'Deskripsi test',
        ];
        $response = $this->post('/galeri', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('galeris', ['judul' => 'Galeri Test']);
    }

    public function test_show_galeri()
    {
        $galeri = Galeri::factory()->create();
        $response = $this->get('/galeri/'.$galeri->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed()
    {
        $galeri = Galeri::factory()->create();
        $response = $this->get('/galeri/'.$galeri->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update_galeri()
    {
        $galeri = Galeri::factory()->create();
        $user = User::factory()->create();
        $kategori = Kategori::factory()->create();
        $data = [
            'id_user' => $user->id,
            'id_kategori' => $kategori->id,
            'judul' => 'Galeri Updated',
            'tanggal' => now()->toDateString(),
            'tipe' => 'gambar',
            'video' => null,
            'gambar' => 'gambar2.jpg',
            'deskripsi' => 'Deskripsi update',
        ];
        $response = $this->put('/galeri/'.$galeri->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('galeris', ['judul' => 'Galeri Updated']);
    }

    public function test_destroy_galeri()
    {
        $galeri = Galeri::factory()->create();
        $response = $this->delete('/galeri/'.$galeri->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('galeris', ['id' => $galeri->id]);
    }
}
