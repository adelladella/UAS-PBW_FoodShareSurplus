<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatsApiTest extends TestCase
{
    /**
     * Test the donor statistics API endpoint.
     */
    public function test_donor_stats_api_returns_correct_structure(): void
    {
        // User ID 2 is a donor seeded in DatabaseSeeder
        $response = $this->getJson('/api/users/2/stats');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'role',
                     'user' => [
                         'id',
                         'name',
                         'organization_name',
                         'email',
                         'phone',
                         'address'
                     ],
                     'total_items',
                     'total_portions',
                     'claimed_portions',
                     'pending_portions',
                     'helped_count',
                     'categories',
                     'recent_donations'
                 ]);
    }

    /**
     * Test the lembaga statistics API endpoint.
     */
    public function test_lembaga_stats_api_returns_correct_structure(): void
    {
        // User ID 4 is a lembaga seeded in DatabaseSeeder
        $response = $this->getJson('/api/users/4/stats');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'role',
                     'user' => [
                         'id',
                         'name',
                         'organization_name',
                         'email',
                         'phone',
                         'address'
                     ],
                     'total_claims',
                     'total_portions',
                     'approved_portions',
                     'approved_count',
                     'pending_count',
                     'rejected_count',
                     'pickup_count',
                     'delivery_count',
                     'pickup_methods',
                     'categories',
                     'recent_claims'
                 ]);
    }
}
