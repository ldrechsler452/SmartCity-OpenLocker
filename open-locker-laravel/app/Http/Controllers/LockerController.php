<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Locker;
use App\Models\Station;
use Inertia\Inertia;
use Inertia\Response;

class LockerController extends Controller
{
    public function index(Station $station): Response
    {
        return Inertia::render('Lockers/Index', [
            'lockers' => $station->getLockers()->load('content'),
        ]);
    }

    public function show(Locker $locker): Response
    {
        return Inertia::render('Lockers/Show', [
            'locker' => $locker->load('content'),
        ]);
    }

    public function open(Locker $locker): Response
    {
        // TODO: Tell API to open the door

        $result_code = null;
        $result = [];
        exec("python3 /var/scripts/opendoor.py " . escapeshellarg($locker->getId()), $result, $result_code );

        $locker
            ->open()
            ->setLastOpenedAt(now())
            ->save();

        return Inertia::render('Lockers/Open', [
            'locker' => $locker,
        ]);


    }

    public function close(Locker $locker): void
    {
        $locker
            ->close()
            ->save();
    }
}
