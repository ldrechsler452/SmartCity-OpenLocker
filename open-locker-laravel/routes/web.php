<?php

use App\Http\Controllers\LockerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Lockers
Route::get('/stations/{station:id}/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/lockers/{locker:id}', [LockerController::class, 'show'])->name('lockers.show');
Route::get('/lockers/{locker:id}/open', [LockerController::class, 'open'])->name('lockers.open');
Route::get('/lockers/{locker:id}/close', [LockerController::class, 'close'])->name('lockers.close');

// Stations
Route::get('/stations', [StationController::class, 'index'])->name('stations.index');

require __DIR__.'/auth.php';
