<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\User;
use App\Models\Coach;
use App\Models\SportType;
use App\Models\Facility;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Booking = Booking::with(['user','facility'])->get();
        return view('bookings.index', compact('Booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $users = User::all();
            $facilities = Facility::all();
               $SportType = SportType::all();
                $Coach = Coach::all();
    return view('bookings.create', compact('users','facilities','SportType','Coach'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Bookings store request:', $request->all());

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'facility_id' => 'required|exists:facilities,id',
            'date' => 'required|date',
            'start_time' => 'required|string',
             'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking added successfully.');
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
    $facilities = Facility::all();
         $Bookings = Booking::findOrFail($id);
         return view('bookings.edit', compact('facilities','users', 'Bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       Log::info('Bookings update request:', $request->all());

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'facility_id' => 'required|exists:facilities,id',
            'date' => 'required|date',
            'start_time' => 'required|string',
             'end_time' => 'required|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $Bookings = Booking::findOrFail($id);

          $Bookings->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $Bookings = Booking::findOrFail($id);
        $Bookings->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
