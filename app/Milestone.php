<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = ['goal_id', 'body', 'is_complete'];

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
