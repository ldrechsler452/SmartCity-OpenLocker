<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Image;
use App\Models\Locker;
use App\Models\Station;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Stations/Index', [
            'stations' => Station::all()->load('lockers', 'lockers.content', 'image'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Stations/Create');
    }

    public function store(): RedirectResponse
    {
        $image = null;
        $imageFile = null;
        if (null !== request()->file('image')) {
            $imageFile = request()->file('image');
            $image = ImageService::store($imageFile);
        }

        $station = (new Station())
            ->setName(request()->input('name'))
            ->setAddress(request()->input('address'))
            ->setDistance(request()->input('distance'));

        if (null !== $imageFile)
        {
            $station->setImage($image);
        }

        $station->save();

        return redirect()->route('stations.index');
    }

    public function delete(Station $station): RedirectResponse
    {
        ImageService::delete($station->getImage());
        $station->delete();

        return redirect()->route('stations.index');
    }

    public function image(Station $station): StreamedResponse
    {
    return Storage::download($station->getImage()?->getFilePath());

    }
}
