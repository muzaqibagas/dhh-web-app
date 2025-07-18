<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\AcaraAkademik;

class AcaraAkademikTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed()
    {
        $response = $this->get('/acara-akademik');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed()
    {
        $response = $this->get('/acara-akademik/create');
        $response->assertStatus(200);
    }

    public function test_store_acaraakademik()
    {
        $mahasiswa = \App\Models\User::factory()->create();
        $staffdept = \App\Models\StaffDept::factory()->create();
        $kolokium = \App\Models\Kolokium::factory()->create();
        $seminar = \App\Models\Seminar::factory()->create();
        $sidang = \App\Models\Sidang::factory()->create();
        $data = [
            'id_mahasiswa' => $mahasiswa->id,
            'id_staffdept' => $staffdept->id,
            'id_kolokium' => $kolokium->id,
            'id_seminar' => $seminar->id,
            'id_sidang' => $sidang->id,
        ];
        $response = $this->post('/acara-akademik', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('acara_akademiks', $data);
    }

    public function test_show_acaraakademik()
    {
        $acara = AcaraAkademik::factory()->create();
        $response = $this->get('/acara-akademik/' . $acara->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed()
    {
        $acara = AcaraAkademik::factory()->create();
        $response = $this->get('/acara-akademik/' . $acara->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_acaraakademik()
    {
        $acara = AcaraAkademik::factory()->create();
        $data = [
            'id_mahasiswa' => $acara->id_mahasiswa,
            'id_staffdept' => $acara->id_staffdept,
            'id_kolokium' => $acara->id_kolokium,
            'id_seminar' => $acara->id_seminar,
            'id_sidang' => $acara->id_sidang,
        ];
        $response = $this->put('/acara-akademik/' . $acara->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('acara_akademiks', $data);
    }

    public function test_destroy_acaraakademik()
    {
        $acara = AcaraAkademik::factory()->create();
        $response = $this->delete('/acara-akademik/' . $acara->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('acara_akademiks', ['id' => $acara->id]);
    }
}
