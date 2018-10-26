<?php

namespace App\Http\Controllers;

use App\Milestone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MilestonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Milestone::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Milestone::create([
            'body' => $request->body,
            'goal_id' => $request->goal_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show(Milestone $milestone)
    {
        return $milestone;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        $completedAt = $request->is_complete ? Carbon::now() : null;
        $milestone->update([
            'goal_id' => $request->goal_id,
            'body' => $request->body,
            'is_complete' => $completedAt
        ]);

        return $milestone;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone)
    {
        return $milestone->delete();
    }
}
