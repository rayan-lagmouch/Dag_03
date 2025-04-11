<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * CUSTOMER ROUTES (Role: customer)
 */
Route::middleware(['auth', 'role:customer'])->group(function () {
    // View personal reservations
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Route in web.php
    Route::get('reservations//scores', [ScoreController::class, 'show'])->name('scores.my');


    // Update lane
    Route::get('/reservations/{reservation}/edit-lane', [ReservationController::class, 'editLane'])->name('reservations.edit.lane');
    Route::post('/reservations/{reservation}/update-lane', [ReservationController::class, 'updateLane'])->name('reservations.update.lane');

    // Update package
    Route::get('/reservations/{reservation}/edit-package', [ReservationController::class, 'editPackage'])->name('reservations.edit.package');
    Route::post('/reservations/{reservation}/update-package', [ReservationController::class, 'updatePackage'])->name('reservations.update.package');
});

/**
 * EMPLOYEE ROUTES (Role: employee)
 */
Route::middleware(['auth', 'role:employee'])->group(function () {
    // Confirmed reservations overview
    Route::get('/reservations/confirmed', [ReservationController::class, 'confirmed'])->name('reservations.confirmed');

    // Customer personal data overview
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Contact info (edit email, etc.)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{customer}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts/{customer}/update', [ContactController::class, 'update'])->name('contacts.update');

    // Edit Scores
    Route::get('/scores/editable', [ScoreController::class, 'editable'])->name('scores.editable');
    Route::get('/scores/{score}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
    Route::post('/scores/{score}/update', [ScoreController::class, 'update'])->name('scores.update');
});

require __DIR__.'/auth.php';
