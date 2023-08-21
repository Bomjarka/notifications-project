<?php

namespace Tests\Feature;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoalsControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_user_goals_index(): void
    {
        $user = User::factory()->create();
        $goal = Goal::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get('/api/user/' . $user->id . '/goals');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $this->assertTrue($content['success']);
        $this->assertEquals($content['data'][0], $goal->toArray());
    }
}
