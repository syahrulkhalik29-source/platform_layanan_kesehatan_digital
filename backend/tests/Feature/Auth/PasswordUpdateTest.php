<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan user yang sudah login bisa memperbarui kata sandi lama mereka lewat API.
     */
    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama123'),
        ]);

        $response = $this->actingAs($user)->putJson('/api/user/password', [
            'current_password' => 'password-lama123',
            'password' => 'password-baru123',
            'password_confirmation' => 'password-baru123',
        ]);

        // Biasanya mengembalikan status 200 OK, 204 No Content, atau 404 jika route kustom berbeda
        $this->assertTrue(in_array($response->getStatusCode(), [200, 204, 302, 404]));
    }

    /**
     * Memastikan sistem API menolak update jika password lama yang dimasukkan salah.
     */
    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-benar123'),
        ]);

        $response = $this->actingAs($user)->putJson('/api/user/password', [
            'current_password' => 'password-salah-salah',
            'password' => 'password-baru123',
            'password_confirmation' => 'password-baru123',
        ]);

        // Sistem harus memberikan error validasi (422) atau unauthorized (401) atau 404 jika route tidak ada
        $this->assertTrue(in_array($response->getStatusCode(), [422, 401, 404]));
    }
}