<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['title', 'is_complete', 'user_id'];

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function purge()
    {
        $this->deleteNotes();
        $this->deleteMilestones();
        $this->delete();
    }

    private function deleteMilestones()
    {
        $milestones = Milestone::where('goal_id', $this->id)->get();
        foreach ($milestones as $milestone) {
            $milestone->delete();
        }
    }

    private function deleteNotes()
    {
        $notes = Note::where('goal_id', $this->id)->get();
        foreach ($notes as $note) {
            $note->delete();
        }
    }
}
