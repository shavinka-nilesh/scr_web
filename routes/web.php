<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CoachingSessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Models\Booking;
use App\Models\User;
use App\Models\Coach;
use App\Models\Facility;
use App\Models\CoachingSession;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //resource routes 
    Route::resource('facilities', FacilityController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('coaches', CoachController::class);
    Route::resource('coachingsessions', CoachingSessionController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [\App\Http\Controllers\CalendarController::class, 'events'])->name('calendar.events');
Route::post('/calendar/store', [\App\Http\Controllers\CalendarController::class, 'store'])->name('calendar.store');

});
Route::middleware(['auth', 'admin.only'])->group(function () {
    // Route::resource('facilities', FacilityController::class);
    // Route::resource('coaches', CoachController::class);
});

require __DIR__.'/auth.php';
