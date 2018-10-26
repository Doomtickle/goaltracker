<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Milestone;
use App\Goal;

class MilestoneTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_milestone_belongs_to_a_goal()
    {
        $milestone = factory(Milestone::class)->create();

        $this->assertInstanceOf(Goal::class, $milestone->goal);
    }
}
