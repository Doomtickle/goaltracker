<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['goal_id', 'body'];

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
