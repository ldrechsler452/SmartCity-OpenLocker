<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Locker;
use App\Models\Station;
use App\Services\ScriptService;
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
        ScriptService::openLocker($locker);

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
        // TODO: This needs a way for the Raspi to tell us the locker has been closed.
        $locker
            ->close()
            ->save();
    }
}
