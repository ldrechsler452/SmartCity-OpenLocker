<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Inertia\Inertia;
use Inertia\Response;

class StationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Stations/Index', [
            'stations' => Station::all()->load('lockers'),
        ]);
    }
}
