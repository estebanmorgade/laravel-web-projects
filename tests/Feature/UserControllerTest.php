<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class UserControllerTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_api_can_see_all_users(): void
    {
        $users = User::factory(3)->create();

        Sanctum::actingAs($users[0]);

        $response = $this->getJson('api/users');
         $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonFragment([
                    'name' => $users[0]->name,
                 ])
                 ->assertJsonFragment([
                    'name' => $users[1]->name,
                 ])
                 ->assertJsonFragment([
                    'name' => $users[2]->name,
                 ]);
    }

    public function test_api_can_create_user(): void
    {
        $user = User::factory()->create();
        
        Sanctum::actingAs($user);

         $payload = [
            'name' => 'Test User',
            'email' => 'jaja@jaja.com',
            'role' => 'admin',
            'password' => '12345678'
         ];

        $response = $this->postJson('api/users', $payload);

         $response->assertStatus(201)
                 ->assertJsonFragment([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                 ]);

         $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
         ]);
    }

    public function test_api_can_update_user(): void
    {
        $user = User::factory()->create();
        
        Sanctum::actingAs($user);

         $payload = [
            'name' => 'Updated User',
            'email' => $user->email,
            'role' => $user->role
         ];

        $response = $this->putJson("api/users/{$user->id}", $payload);

         $response->assertStatus(200)
                 ->assertJsonFragment([
                    'name' => 'Updated User'
                 ]);

         $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User'
         ]);
    }

    public function test_api_can_delete_user(): void
    {
        $user = User::factory()->create();
        
        Sanctum::actingAs($user);

        $response = $this->deleteJson("api/users/{$user->id}");

         $response->assertStatus(200);

         $this->assertDatabaseMissing('users', [
            'id' => $user->id
         ]);
    }
}
