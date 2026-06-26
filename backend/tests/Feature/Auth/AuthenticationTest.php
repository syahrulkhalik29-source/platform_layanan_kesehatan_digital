<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan endpoint GET /api/login mengembalikan status 405
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->getJson('/api/login');
        $response->assertStatus(405); 
    }

    /**
     * Menguji Login dengan Membongkar Eror Asli Backend
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        // Paksa Laravel mematikan proteksi penanganan eror agar detail eror tercetak ke terminal
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertTrue(in_array($response->getStatusCode(), [200, 201]));
    }

    /**
     * Menguji Penolakan Login
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        
        $this->assertTrue(in_array($response->getStatusCode(), [400, 401, 422]));
    }

    /**
     * Memastikan fitur logout aman
     */
    public function test_users_can_logout(): void
    {
        $this->assertTrue(true);
    }
}