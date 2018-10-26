<?php

namespace App\Http\Controllers;

use App\Goal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Milestone;

class GoalsController extends Controller
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
        return Goal::with(['milestones', 'notes'])->latest()->paginate('16');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        return Goal::create([
            'title' => $request->title,
            'user_id' => $user->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return Goal::with(['milestones', 'notes'])->find($goal->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $title = $request->title ?? $goal->title;
        $completedAt = $request->is_complete ? Carbon::now() : null;

        $goal->update([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'is_complete' => $completedAt
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        if (auth()->user()->id = $goal->user_id) {
            $goal->purge();
        }
    }
}
