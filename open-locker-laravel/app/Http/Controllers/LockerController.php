<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Station;
use Inertia\Inertia;

class LockerController extends Controller
{
    public function index(Station $station)
    {
        return Inertia::render('Locker/LockerIndex', [
            'lockers' => $station->getLockers(),
        ]);
    }
}
