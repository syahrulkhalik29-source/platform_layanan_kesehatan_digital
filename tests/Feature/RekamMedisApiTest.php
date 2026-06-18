<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // <-- Tambahkan baris ini
use Tests\TestCase;

class RekamMedisApiTest extends TestCase
{
    use RefreshDatabase; // <-- Serta tambahkan baris ini di dalam class

    /** @test */
    public function test_api_rekam_medis_bisa_diakses()
    {
        // Menguji apakah endpoint GET /api/rekam-medis merespon dengan normal (Status 200)
        $response = $this->getJson('/api/rekam-medis');

        $response->assertStatus(200);
    }
}