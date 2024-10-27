<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user:id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user:id}/content', [UserController::class, 'content'])->name('users.content');

// Lockers
Route::get('/stations/{station:id}/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/lockers/{locker:id}', [LockerController::class, 'show'])->name('lockers.show');
Route::get('/lockers/{locker:id}/open', [LockerController::class, 'open'])->name('lockers.open');
Route::get('/lockers/{locker:id}/close', [LockerController::class, 'close'])->name('lockers.close');

// Stations
Route::get('/stations', [StationController::class, 'index'])->name('stations.index');
Route::get('/stations/create', [StationController::class, 'create'])->name('stations.create');
Route::post('/stations', [StationController::class, 'store'])->name('stations.store');
Route::delete('/stations/{station:ud}', [StationController::class, 'delete'])->name('stations.delete');

// Contents
Route::get('/contents', [ContentController::class, 'index'])->name('content.index');
Route::get('/contents/create', [ContentController::class, 'create'])->name('content.create');
Route::post('/contents', [ContentController::class, 'store'])->name('content.store');
Route::get('/contents/{content:id}/take', [ContentController::class, 'take'])->name('content.take');
Route::get('/contents/{content:id}/return', [ContentController::class, 'return'])->name('content.return');
Route::delete('/contents/{content:id}', [ContentController::class, 'delete'])->name('content.delete');

require __DIR__.'/auth.php';
