<?php

namespace Tests\Feature;

use App\Models\Jenjang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JenjangTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed()
    {
        $response = $this->get('/jenjang');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed()
    {
        $response = $this->get('/jenjang/create');
        $response->assertStatus(200);
    }

    public function test_store_jenjang()
    {
        $data = [
            'nama' => 'Jenjang Test',
            // tambahkan field lain sesuai kebutuhan
        ];
        $response = $this->post('/jenjang', $data);
        $response->assertStatus(302); // redirect setelah simpan
        $this->assertDatabaseHas('jenjangs', ['nama' => 'Jenjang Test']);
    }

    public function test_show_jenjang()
    {
        $jenjang = Jenjang::factory()->create();
        $response = $this->get('/jenjang/'.$jenjang->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed()
    {
        $jenjang = Jenjang::factory()->create();
        $response = $this->get('/jenjang/'.$jenjang->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update_jenjang()
    {
        $jenjang = Jenjang::factory()->create();
        $data = [
            'nama' => 'Jenjang Updated',
            // tambahkan field lain sesuai kebutuhan
        ];
        $response = $this->put('/jenjang/'.$jenjang->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('jenjangs', ['nama' => 'Jenjang Updated']);
    }

    public function test_destroy_jenjang()
    {
        $jenjang = Jenjang::factory()->create();
        $response = $this->delete('/jenjang/'.$jenjang->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('jenjangs', ['id' => $jenjang->id]);
    }
}
