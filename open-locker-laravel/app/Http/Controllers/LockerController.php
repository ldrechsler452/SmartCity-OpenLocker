<?php

namespace App\Http\Controllers;

use App\Models\locker;
use Inertia\Inertia;

class LockerController extends Controller
{
    public function index()
    {
        return Inertia::render('Locker/LockerIndex', [
            'lockers' => Locker::all(),
        ]);
    }
}
