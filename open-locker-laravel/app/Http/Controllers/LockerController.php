<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Locker;
use App\Models\Station;
use App\Services\ImageService;
use App\Services\ScriptService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LockerController extends Controller
{
    public function index(Station $station): Response
    {
        return Inertia::render('Lockers/Index', [
            'lockers' => $station->getLockers()->load('content', 'content.image'),
            'station' => $station
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

    public function create(Station $station): Response
    {
        return Inertia::render('Lockers/Create', ['station' => $station]);
    }

    public function store(): RedirectResponse
    {
        $image = null;
        $imageFile = null;
        if (null !== request()->file('image')) {
            $imageFile = request()->file('image');
            $image = ImageService::store($imageFile);
        }

        $content = (new Content())
            ->setName(request()->input('itemName'));
        if (null !== $imageFile)
        {
            $content->setImage($image);
        }
        $content->save();

        $station_id = request()->input('station_id');
        $locker = (new Locker())
            ->setDesignation(request()->input('lockerDesignation'))
            ->setContent($content)
            ->setStation(Station::find($station_id));



        $locker->save();

        return redirect()->route('lockers.index', $station_id);
    }

    public function image(Locker $locker): StreamedResponse
    {
        return Storage::download($locker->getContent()?->getImage()?->getFilePath());
    }
}
