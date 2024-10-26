<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Station;
use Inertia\Inertia;
use Inertia\Response;

class LockerController extends Controller
{
    public function index(Station $station): Response
    {
        return Inertia::render('Lockers/Index', [
            'lockers' => $station->getLockers(),
        ]);
    }

    public function open(Locker $locker): void
    {
        // TODO: Tell API to open the door

        $locker
            ->open()
            ->setLastOpenedAt(now())
            ->save();
    }

    public function close(Locker $locker): void
    {
        $locker
            ->close()
            ->save();
    }
}
