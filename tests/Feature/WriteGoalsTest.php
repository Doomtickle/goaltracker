<?php

namespace Tests\Feature;

use App\Goal;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WriteGoalsTest extends TestCase
{
    use RefreshDatabase;

    private $goal;
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->goal = factory(Goal::class)->make()->toArray();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_unauthenticated_user_cannot_create_a_goal()
    {
        $this->post('/goals', $this->goal)->assertRedirect();
    }

    /** @test */
    public function an_authenticated_user_can_create_a_goal()
    {
        $this->actingAs($this->user);
        $this->createGoal();
        $this->assertDatabaseHas('goals', $this->goal);
    }

    /** @test */
    public function an_authenticated_user_can_update_a_goal()
    {
        $this->actingAs($this->user);
        $goalData = factory(Goal::class)->make()->toArray();
        $this->createGoal($goalData);
        $originalGoal = Goal::first();
        $this->patch('/goals/' . $originalGoal->id, $this->goal)
             ->assertSuccessful()
             ->assertJsonFragment([
                 'title' => $this->goal['title']
            ]);
        $this->assertDatabaseHas('goals', $this->goal);
        $this->assertDatabaseMissing('goals', $originalGoal->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_delete_their_goal()
    {
        $this->actingAs($this->user);
        $goal = $this->createGoal();
        $this->delete('/goals/' . $goal->id)->assertSuccessful();
        $this->assertDatabaseMissing('goals', $goal->toArray());
    }

    /** @test */
    public function a_goal_can_be_completed()
    {
        $this->actingAs($this->user);
        $goal = $this->createGoal();
        $newData = [
            'title' => 'New Title',
            'is_complete' => 1
        ];
        $this->patch('/goals/' . $goal->id, $newData)->assertSuccessful();
        $this->assertEquals(1, Goal::whereNotNull('is_complete')->count());
    }

    public function createGoal($details = null)
    {
        $goal = $details ?? $this->goal;
        $this->post('/goals', $goal);

        return Goal::where('title', $goal['title'])->first();
    }
}
