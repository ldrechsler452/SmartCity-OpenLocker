<?php

use App\Http\Controllers\LockerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Lockers
Route::get('stations/{station:id}/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('lockers/{locker:id}', [LockerController::class, 'single'])->name('lockers.single');
Route::patch('lockers/{locker:id}/open', [LockerController::class, 'open'])->name('lockers.open');
Route::patch('lockers/locker:id}/close', [LockerController::class, 'close'])->name('lockers.close');

// Stations
Route::get('/stations', [StationController::class, 'index'])->name('stations.index');

require __DIR__.'/auth.php';
