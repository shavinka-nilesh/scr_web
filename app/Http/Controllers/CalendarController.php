<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\CoachingSession;
use App\Models\Coach;
use App\Models\SportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CalendarController extends Controller
{
    public function index()
{
     $sportTypes = SportType::all(); 
     $facilities = Facility::all();
     $coaches = Coach::all();
    return view('calendar.calendar', compact('facilities','coaches','sportTypes'));
}

public function events()
{

    $bookings = Booking::all();
    Log::info('Bookings in calendar:', $bookings->toArray());
    $sessions = CoachingSession::all();

    $events = [];

    foreach ($bookings as $b) {
        $events[] = [
            'title' => 'Booking',
           'start' => \Carbon\Carbon::parse($b->date)->format('Y-m-d') . 'T' . $b->start_time,
           'end' => \Carbon\Carbon::parse($b->date)->format('Y-m-d') . 'T' . $b->end_time,
            'color' => 'blue',
               'textColor' => 'black'
        ];
    }

    foreach ($sessions as $s) {
        $events[] = [
            'title' => 'Coaching Session',
           'start' => \Carbon\Carbon::parse($s->session_date)->format('Y-m-d') . 'T' . $s->start_time,
 'end' => \Carbon\Carbon::parse($s->session_date)->format('Y-m-d') . 'T' . $s->end_time,
            'color' => 'purple',
        ];
    }

   Log::info('Returned calendar events:', $events);

    return response()->json($events);
}

public function store(Request $request)
{
    Log::info('Calendar store request:', $request->all());

    if ($request->has('date')) {
        // Log::info("Booking Store Called".$request);
        // This is a booking
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
            'sport_type_id'=> 'required|string',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'facility_id' => $request->facility_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'sport_type_id' => $request->sport_type_id,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Booking added successfully.');

    } elseif ($request->has('session_date')) {
        //Log::info("Session Store Called".$request);
        // This is a coaching session
        $request->validate([
            'coach_id' => 'required|exists:coaches,id',
            'session_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
            'session_sport_type'=>'required|string',
        ]);

        CoachingSession::create([
            'user_id' => auth()->id(),
            'coach_id' => $request->coach_id,
            'session_date' => $request->session_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'sport_type_id' => $request->session_sport_type,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Coaching session added successfully.');
    }

    return redirect()->route('calendar.index')->with('error', 'Invalid request format.');
}

}
