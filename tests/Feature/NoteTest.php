<?php

namespace Tests\Feature;

use App\Note;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created()
    {
        $note = factory(Note::class)->make();
        $this->actingAs(factory(User::class)->create());

        $this->post('notes', $note->toArray())->assertSuccessful();
        $this->assertDatabaseHas('notes', $note->toArray());
    }

    /** @test */
    public function it_can_be_updated()
    {
        $note = factory(Note::class)->create();
        $newData = [
            'body' => 'Updated',
            'goal_id' => $note->goal->id
        ];
        $this->actingAs(factory(User::class)->create());
        $this->assertDatabaseHas('notes', ['body' => $note->body]);

        $this->patch('/notes/' . $note->id, $newData);
        $this->assertDatabaseHas('notes', $newData);
        $this->assertDatabaseMissing('notes', ['body' => $note->body]);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $note = factory(Note::class)->create();
        $this->actingAs(factory(User::class)->create());

        $this->delete('/notes/' . $note->id)->assertSuccessful();
    }
}
