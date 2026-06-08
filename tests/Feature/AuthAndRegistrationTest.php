<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthAndRegistrationTest extends TestCase
{
    /**
     * Test successful login with correct credentials.
     */
    public function test_login_with_correct_credentials_succeeds(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@foodshare.id',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'user' => [
                         'email' => 'admin@foodshare.id',
                         'role' => 'admin'
                     ]
                 ]);
    }

    /**
     * Test failed login with incorrect credentials.
     */
    public function test_login_with_incorrect_credentials_fails(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@foodshare.id',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Email atau kata sandi salah. Pastikan kredensial Anda benar.'
                 ]);
    }

    /**
     * Test registration request submission.
     */
    public function test_registration_request_can_be_submitted(): void
    {
        $response = $this->postJson('/api/register-request', [
            'organization_name' => 'Panti Asuhan Tes',
            'contact_person' => 'Budi Penguji',
            'email' => 'budites@gmail.com',
            'phone' => '081234567899',
            'address' => 'Jl. Pengujian No. 5',
            'google_maps_link' => 'https://maps.google.com/?q=-1.26,116.83',
            'role' => 'lembaga'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Pendaftaran berhasil dikirim! Pengajuan Anda sedang diverifikasi manual oleh Admin.'
                 ])
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data_id'
                 ]);
    }
}
