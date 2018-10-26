<?php

namespace Tests\Feature;

use App\Milestone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class GoalMilestonesTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    /** @test */
    public function goals_have_milestones()
    {
        $milestone = factory(Milestone::class)->create();
        $this->actingAs($this->user);

        $this->get('/goals/'. $milestone->goal->id)
             ->assertSuccessful()
             ->assertJsonFragment([
                 'body' => $milestone->body
        ]);
    }

    /** @test */
    public function milestones_for_goal_are_deleted_when_goal_is_deleted()
    {
        $milestone = factory(Milestone::class)->create();
        $this->actingAs($this->user);
        $this->delete('/goals/' . $milestone->goal->id);

        $this->assertDatabaseMissing('milestones', ['body' => $milestone->body]);
    }
}
