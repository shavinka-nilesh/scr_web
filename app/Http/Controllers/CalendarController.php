<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\CoachingSession;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
{
     $facilities = Facility::all();
    return view('calendar.calendar', compact('facilities'));
}

public function events()
{
    $bookings = Booking::select('id', 'date as start', 'start_time', 'end_time')->get();
    $sessions = CoachingSession::select('id', 'session_date as start', 'start_time', 'end_time')->get();

    $events = [];

    foreach ($bookings as $b) {
        $events[] = [
            'title' => 'Booking',
            'start' => $b->start . 'T' . $b->start_time,
            'end'   => $b->start . 'T' . $b->end_time,
            'color' => 'blue',
        ];
    }

    foreach ($sessions as $s) {
        $events[] = [
            'title' => 'Coaching Session',
            'start' => $s->start . 'T' . $s->start_time,
            'end'   => $s->start . 'T' . $s->end_time,
            'color' => 'purple',
        ];
    }

    return response()->json($events);
}

public function store(Request $request)
{
    // Example: add booking, you can adapt this for sessions too
    Booking::create([
        'user_id' => auth()->id(),
        'facility_id' => $request->facility_id,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'status' => 'pending',
    ]);

    return response()->json(['success' => true]);
}

}
