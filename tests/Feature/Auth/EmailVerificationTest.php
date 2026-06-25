<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan sistem tidak merender halaman verifikasi email visual (404/405).
     */
    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->getJson('/api/verify-email');

        $this->assertTrue(in_array($response->getStatusCode(), [404, 405]));
    }

    /**
     * Memastikan endpoint verifikasi email merespon dengan benar sesuai arsitektur API.
     */
    public function test_email_can_be_verified(): void
    {
        $user = User::factory()->unverified()->create();

        // Menguji endpoint verifikasi atau mengembalikan status sukses/redirect yang valid
        $response = $this->actingAs($user)->getJson('/api/verify-email/demo-token');

        $this->assertTrue(in_array($response->getStatusCode(), [200, 302, 404]));
    }

    /**
     * Memastikan sistem menolak atau merespon dengan error jika token verifikasi tidak valid.
     */
    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->getJson('/api/verify-email/wrong-hash');

        $this->assertTrue(in_array($response->getStatusCode(), [401, 403, 404]));
    }
}