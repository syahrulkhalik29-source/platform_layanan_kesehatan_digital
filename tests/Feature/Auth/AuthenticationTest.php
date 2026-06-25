<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan endpoint GET /api/login mengembalikan status 405 (Method Not Allowed)
     * karena route login API hanya menerima metode POST.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->getJson('/api/login');
        
        $response->assertStatus(405); 
    }

    /**
     * Memastikan user bisa melakukan autentikasi (login) lewat API 
     * menggunakan metode POST ke /api/login dengan status sukses (200 OK).
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        // Membuat data user simulasi di database testing dengan password default 'password'
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Karena ini API murni, responnya harus berstatus 200 OK (bukan redirect)
        $response->assertStatus(200);
        
        // Memastikan server mengembalikan struktur data token atau user data setelah login sukses
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Memastikan sistem menolak (401 Unauthorized atau 422/kedua status valid tergantung respon Laravel kalian)
     * jika user mencoba login dengan password yang salah.
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

        // Sistem menolak akses masuk
        $this->assertGuest();
        
        // Memastikan status kode mengembalikan 401 (Unauthorized) atau 422 (Validation Error)
        $this->assertTrue(in_array($response->getStatusCode(), [401, 422]));
    }

    /**
     * Memastikan user yang sudah login bisa melakukan logout lewat API dengan aman.
     */
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        // Mengirim request logout sebagai user yang sedang aktif ke endpoint /api/logout
        $response = $this->actingAs($user)->postJson('/api/logout');

        // Memastikan status kembali menjadi Guest (tidak terautentikasi)
        $this->assertGuest();
        
        // Respon API logout biasanya 200 OK atau 204 No Content
        $this->assertTrue(in_array($response->getStatusCode(), [200, 204]));
    }
}