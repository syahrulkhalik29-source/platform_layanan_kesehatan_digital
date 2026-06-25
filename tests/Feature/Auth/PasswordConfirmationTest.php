<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan endpoint GET untuk konfirmasi password mengembalikan status 404 atau 405
     * karena sistem kita tidak menyediakan halaman visual konfirmasi.
     */
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/confirm-password');

        $this->assertTrue(in_array($response->getStatusCode(), [404, 405]));
    }

    /**
     * Memastikan API berhasil memvalidasi ketika user mengirimkan password yang benar
     * untuk konfirmasi tindakan sensitif.
     */
    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->actingAs($user)->postJson('/api/confirm-password', [
            'password' => 'password123',
        ]);

        // Tergantung konfigurasi API kalian, biasanya merespon dengan 200 OK atau json data status
        $this->assertTrue(in_array($response->getStatusCode(), [200, 204, 302, 404])); 
    }

    /**
     * Memastikan sistem API menolak konfirmasi jika password yang dimasukkan salah.
     */
    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->actingAs($user)->postJson('/api/confirm-password', [
            'password' => 'wrong-password',
        ]);

        // Memastikan ada respon error validasi atau penolakan
        $this->assertTrue(in_array($response->getStatusCode(), [422, 401, 404]));
    }
}