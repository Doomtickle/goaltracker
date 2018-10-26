<?php

namespace Tests\Feature;

use App\User;
use App\Milestone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MilestonesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created()
    {
        $milestone = factory(Milestone::class)->make()->toArray();
        $this->actingAs(factory(User::class)->create());

        $this->post('/milestones', $milestone)->assertSuccessful();
        $this->assertDatabaseHas('milestones', $milestone);
    }

    /** @test */
    public function it_can_be_updated()
    {
        $milestone = factory(Milestone::class)->create();
        $newData = [
            'body' => 'Updated',
            'goal_id' => $milestone->goal->id
        ];
        $this->actingAs(factory(User::class)->create());

        $this->patch('/milestones/' . $milestone->id, $newData)->assertSuccessful();
        $this->assertDatabaseHas('milestones', $newData);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $milestone = factory(Milestone::class)->create();
        $this->assertDatabaseHas('milestones', $milestone->toArray());
        $this->actingAs(factory(User::class)->create());

        $this->delete('/milestones/' . $milestone->id);
        $this->assertDatabaseMissing('milestones', $milestone->toArray());
    }

    /** @test */
    public function it_can_be_completed()
    {
        $this->actingAs(factory(User::class)->create());
        $milestone = factory(Milestone::class)->create();
        $newData = [
            'body' => 'New Body',
            'goal_id' => $milestone->goal->id,
            'is_complete' => 1
        ];
        $this->patch('/milestones/' . $milestone->id, $newData)->assertSuccessful();
        $this->assertEquals(1, Milestone::whereNotNull('is_complete')->count());
    }
}
