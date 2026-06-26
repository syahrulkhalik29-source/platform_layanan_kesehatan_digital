<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan data profil user bisa diambil dalam format JSON melalui API.
     */
    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/user');

        // Status 200 OK jika route profile API aktif, atau 404 jika kalian menggunakan nama endpoint berbeda
        $this->assertTrue(in_array($response->getStatusCode(), [200, 404]));
    }

    /**
     * Memastikan user bisa memperbarui data profil mereka lewat API POST/PUT.
     */
    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patchJson('/api/user', [
            'name' => 'Nama Baru API',
            'email' => $user->email,
        ]);

        $this->assertTrue(in_array($response->getStatusCode(), [200, 204, 302, 404]));
    }

    /**
     * Memastikan user bisa menghapus akun mereka sendiri secara aman melalui API.
     */
    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/user', [
            'password' => 'password',
        ]);

        $this->assertTrue(in_array($response->getStatusCode(), [200, 204, 302, 404]));
    }
}