<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriStaffTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/kategoristaff');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/kategoristaff/create');
        $response->assertStatus(200);
    }

    public function test_store_kategori_staff(): void
    {
        $data = [
            'nama' => 'Kategori Staff Test',
        ];
        $response = $this->post('/kategoristaff', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('kategori_staffs', ['nama' => 'Kategori Staff Test']);
    }

    public function test_show_kategori_staff(): void
    {
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $response = $this->get('/kategoristaff/' . $kategoriStaff->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $response = $this->get('/kategoristaff/' . $kategoriStaff->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_kategori_staff(): void
    {
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $data = [
            'nama' => 'Kategori Staff Updated'
        ];
        $response = $this->put('/kategoristaff/' . $kategoriStaff->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('kategori_staffs', ['nama' => 'Kategori Staff Updated']);
    }

    public function test_destroy_kategori_staff(): void
    {
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $response = $this->delete('/kategoristaff/' . $kategoriStaff->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('kategori_staffs', ['id' => $kategoriStaff->id]);
    }
}
