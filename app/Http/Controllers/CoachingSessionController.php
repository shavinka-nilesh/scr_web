<?php

namespace App\Http\Controllers;
use App\Models\CoachingSession;
use App\Models\User;
use App\Models\Coach;
use App\Models\SportType;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CoachingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $coachingSessions = CoachingSession::with(['user', 'coach'])->get();
        return view('coachingsessions.index', compact('coachingSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $users = User::all();
           $SportType = SportType::all();
    $coaches = Coach::all();
    return view('coachingsessions.create', compact('users', 'coaches','SportType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('CoachingSession store request:', $request->all());

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'coach_id' => 'required|exists:coaches,id',
            'session_date' => 'required|date',
            'start_time' => 'required|string',
             'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        CoachingSession::create($request->all());

        return redirect()->route('coachingsessions.index')->with('success', 'Coaching Session added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $users = User::all();
    $coaches = Coach::all();
      $SportType = SportType::all();
         $coachingSessions = CoachingSession::findOrFail($id);
         return view('coachingsessions.edit', compact('coachingSessions','users', 'coaches','SportType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         Log::info('CoachingSession update request:', $request->all());

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'coach_id' => 'required|exists:coaches,id',
            'session_date' => 'required|date',
            'start_time' => 'required|string',
             'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);
         $coachingSessions = CoachingSession::findOrFail($id);

          $coachingSessions->update($request->all());

        return redirect()->route('coachingsessions.index')->with('success', 'Coaching Session Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $coachingSessions = CoachingSession::findOrFail($id);
        $coachingSessions->delete();

        return redirect()->route('coachingsessions.index')->with('success', 'Coaching Session deleted successfully.');
    }
}
