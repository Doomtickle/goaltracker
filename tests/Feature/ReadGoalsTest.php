<?php

namespace Tests\Feature;

use App\Goal;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Milestone;

class ReadGoalsTest extends TestCase
{
    use RefreshDatabase;

    private $goal;
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->goal = factory(Goal::class)->create();
        $this->user = factory(User::class)->create();
    }
    /** @test */
    public function an_unauthenticated_user_cannot_see_goals()
    {
        $id = $this->goal->id;
        $this->get('/goals')->assertRedirect('/login');
        $this->get('/goals/' . $id)->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_see_goals()
    {
        $this->actingAs($this->user);
        $this->get('/goals')
             ->assertSuccessful()
             ->assertJsonFragment(['title' => $this->goal->title]);
    }

    /** @test */
    public function an_authenticated_user_can_view_a_single_goal()
    {
        $id = $this->goal->id;
        $this->actingAs($this->user);
        $this->get('/goals/' . $id)
             ->assertSuccessful()
             ->assertJsonFragment(['title' => $this->goal->title]);
    }
}
