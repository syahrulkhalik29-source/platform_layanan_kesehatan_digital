<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // <-- Tambahkan baris ini
use Tests\TestCase;

class RekamMedisApiTest extends TestCase
{
    use RefreshDatabase; // <-- Serta tambahkan baris ini di dalam class

    public function test_api_rekam_medis_bisa_diakses(): void
    {
        // 1. Membuat user simulasi baru di dalam memory testing
        $user = \App\Models\User::factory()->create();

        // 2. Berpura-pura bertindak sebagai user yang sudah login ($user)
        $response = $this->actingAs($user)->getJson('/api/rekam-medis');

        $response->assertStatus(200);
    }
}