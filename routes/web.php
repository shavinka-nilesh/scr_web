<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SportTypeController;
use App\Http\Controllers\CoachingSessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CalendarController;
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


    // Calendar Routes
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
Route::post('/calendar/store', [CalendarController::class, 'store'])->name('calendar.store');

// Other routes
Route::get('/coaches-list', [CoachController::class, 'list'])->name('coaches.list');
Route::get('/sport-type-list', [SportTypeController::class, 'list'])->name('sport_types.list');
Route::get('/facility-list', [FacilityController::class, 'list'])->name('facilities.list');
Route::delete('/facility-image/{id}', [FacilityController::class, 'deleteImage'])->name('facility.image.delete');
Route::put('/users/{id}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');



});
Route::middleware(['auth', 'admin.only'])->group(function () {
    // Route::resource('facilities', FacilityController::class);
    // Route::resource('coaches', CoachController::class);
        Route::resource('facilities', FacilityController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('sport_types', SportTypeController::class);
    Route::resource('coaches', CoachController::class);
    Route::resource('coachingsessions', CoachingSessionController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
