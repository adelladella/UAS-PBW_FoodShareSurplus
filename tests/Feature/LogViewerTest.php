<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogViewerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test retrieving the system error logs.
     */
    public function test_can_retrieve_system_logs(): void
    {
        $response = $this->getJson('/api/admin/logs');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'logs'
                 ]);
    }

    /**
     * Test clearing the system logs.
     */
    public function test_can_clear_system_logs(): void
    {
        $response = $this->postJson('/api/admin/logs/clear');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success'
                 ]);
    }
}
