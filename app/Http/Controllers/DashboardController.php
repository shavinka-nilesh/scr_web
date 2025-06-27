<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Coach;
use App\Models\Facility;
use App\Models\CoachingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
public function index()
{
    $coachCount = Coach::count();
    $facilityCount = Facility::count();
    $coachingSessionCount = CoachingSession::whereDate('session_date', '>=', now()->startOfWeek())->count();
    $bookingCount = Booking::whereDate('date', now()->toDateString())->count();

    $last7Days = now()->subDays(6)->toDateString();
    $bookings = Booking::where('date', '>=', $last7Days)
        ->selectRaw('DATE(date) as day, COUNT(*) as count')
        ->groupBy('day')
        ->orderBy('day')
        ->pluck('count', 'day');
Log::info("Counts".$bookingCount);
    $dates = $bookings->keys()->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();
    $counts = $bookings->values()->toArray();

    return view('dashboard', compact(
        'coachCount',
        'facilityCount',
        'coachingSessionCount',
        'bookingCount',
        'dates',
        'counts'
    ));
}
}
