<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan endpoint GET /api/register mengembalikan status 405 (Method Not Allowed)
     * karena route register API hanya menerima metode POST.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->getJson('/api/register');

        $response->assertStatus(405);
    }

    /**
     * Memastikan user baru dapat mendaftar akun dengan sukses melalui API POST.
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'User Baru Demo',
            'email' => 'userbaru@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Status sukses pendaftaran API biasanya 201 Created atau 200 OK
        $this->assertTrue(in_array($response->getStatusCode(), [200, 201]));
    }
}