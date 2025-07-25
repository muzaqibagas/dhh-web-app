<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaffDeptTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_accessed(): void
    {
        $response = $this->get('/staffdept');
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_accessed(): void
    {
        $response = $this->get('/staffdept/create');
        $response->assertStatus(200);
    }

    public function test_store_staff_dept(): void
    {
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $divisi = \App\Models\Divisi::factory()->create();

        $data = [
            'id_kategoristaff' => $kategoriStaff->id,
            'id_divisi' => $divisi->id,
            'foto' => null,
            'nama' => 'Test Staff',
            'tanggal_lahir' => '1990-01-01',
            'nip' => '123456789',
            'jabatan' => 'Staff',
            'email' => 'dosen@gmail.com',
            'keahlian' => 'Programming',
            'sinta' => 'Sinta ID',
            'google_scholar' => 'Google Scholar ID',
            'scopus' => 'Scopus ID',
            'researchgate' => 'ResearchGate ID',
            'website' => 'https://example.com',
            'minat_penelitian' => 'Artificial Intelligence',
            'riwayat_pendidikan' => 'S1 Teknik Informatika',
        ];
        $response = $this->post('/staffdept', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('staff_depts', ['nama' => 'Test Staff']);
    }

    public function test_show_staff_dept(): void
    {
        $staffDept = \App\Models\StaffDept::factory()->create();
        $response = $this->get('/staffdept/' . $staffDept->id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_accessed(): void
    {
        $staffDept = \App\Models\StaffDept::factory()->create();
        $response = $this->get('/staffdept/' . $staffDept->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_update_staff_dept(): void
    {
        $staffDept = \App\Models\StaffDept::factory()->create();
        $kategoriStaff = \App\Models\KategoriStaff::factory()->create();
        $divisi = \App\Models\Divisi::factory()->create();

        $data = [
            'id_kategoristaff' => $kategoriStaff->id,
            'id_divisi' => $divisi->id,
            'foto' => null,
            'nama' => 'Updated Staff',
            'tanggal_lahir' => '1990-01-01',
            'nip' => '123456789',
            'jabatan' => 'Updated Staff',
            'email' => 'dosen2@gmail.com',
            'keahlian' => 'Programming',    
            'sinta' => 'Sinta ID Updated',
            'google_scholar' => 'Google Scholar ID Updated',
            'scopus' => 'Scopus ID Updated',
            'researchgate' => 'ResearchGate ID Updated',
            'website' => 'https://example.com/updated',
            'minat_penelitian' => 'Artificial Intelligence Updated',
            'riwayat_pendidikan' => 'S1 Teknik Informatika Updated',
        ];
        $response = $this->put('/staffdept/' . $staffDept->id, $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('staff_depts', ['nama' => 'Updated Staff']);
    }

    public function test_delete_staff_dept(): void
    {
        $staffDept = \App\Models\StaffDept::factory()->create();
        $response = $this->delete('/staffdept/' . $staffDept->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('staff_depts', ['id' => $staffDept->id]);
    }
}
