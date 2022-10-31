<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itCanGetTheCurrentUser(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
             ->getJson('/api/user')
             ->assertJsonPath('id', $user->id);
    }
}
