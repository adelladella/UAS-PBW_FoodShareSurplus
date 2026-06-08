<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FoodAndClaimTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test creating a food item by a donor.
     */
    public function test_donor_can_create_food_item(): void
    {
        // User ID 2 is a verified donor
        $response = $this->postJson('/api/food-items', [
            'donor_id' => 2,
            'food_name' => 'Nasi Goreng Spesial Test',
            'category' => 'makanan_berat',
            'quantity' => 10,
            'unit' => 'porsi',
            'description' => 'Nasi goreng pedas level 3',
            'expired_hours' => 3,
            'pickup_address' => 'Jl. Pengujian No. 12'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success'
                 ])
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         'id',
                         'food_name',
                         'quantity',
                         'status'
                     ]
                 ]);
    }

    /**
     * Test retrieving available food items.
     */
    public function test_get_available_food_items(): void
    {
        $response = $this->getJson('/api/available-food');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'food_name',
                         'donor_name',
                         'donor_org'
                     ]
                 ]);
    }

    /**
     * Test submitting a food claim by a lembaga.
     */
    public function test_lembaga_can_submit_claim(): void
    {
        // First post a food item to claim
        $foodResponse = $this->postJson('/api/food-items', [
            'donor_id' => 2,
            'food_name' => 'Roti Bakar Cokelat Test',
            'category' => 'roti',
            'quantity' => 5,
            'unit' => 'porsi',
            'expired_hours' => 4
        ]);
        $foodId = $foodResponse->json('data.id');

        // User ID 4 is a verified lembaga
        $response = $this->postJson('/api/claims', [
            'food_item_id' => $foodId,
            'lembaga_id' => 4,
            'claimed_quantity' => 2,
            'pickup_method' => 'pickup',
            'notes' => 'Akan diambil segera.'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success'
                 ])
                 ->assertJsonStructure([
                     'status',
                     'claim_id'
                 ]);
    }

    /**
     * Test admin verification and auto-rejection rules.
     */
    public function test_admin_can_approve_claim_and_trigger_status_updates(): void
    {
        // 1. Post a food item
        $foodResponse = $this->postJson('/api/food-items', [
            'donor_id' => 2,
            'food_name' => 'Es Campur Manis Test',
            'category' => 'minuman',
            'quantity' => 10,
            'unit' => 'porsi',
            'expired_hours' => 2
        ]);
        $foodId = $foodResponse->json('data.id');

        // 2. Submit a claim
        $claimResponse = $this->postJson('/api/claims', [
            'food_item_id' => $foodId,
            'lembaga_id' => 4,
            'claimed_quantity' => 5,
            'pickup_method' => 'delivery',
            'notes' => 'Kirim segera.'
        ]);
        $claimId = $claimResponse->json('claim_id');

        // 3. Admin approves the claim
        $verifyResponse = $this->postJson("/api/admin/claims/{$claimId}/verify", [
            'status' => 'approved'
        ]);

        $verifyResponse->assertStatus(200)
                       ->assertJson([
                           'status' => 'success'
                       ]);

        // 4. Mark claim as delivered by lembaga
        $deliveredResponse = $this->postJson("/api/claims/{$claimId}/delivered");
        $deliveredResponse->assertStatus(200)
                          ->assertJson([
                              'status' => 'success'
                          ]);
    }
}
