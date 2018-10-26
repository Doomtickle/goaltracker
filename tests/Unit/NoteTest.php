<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Note;
use App\Goal;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_note_belongs_to_a_goal()
    {
        $note = factory(Note::class)->create();

        $this->assertInstanceOf(Goal::class, $note->goal);
    }
}
