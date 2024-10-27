<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Image;
use App\Models\Locker;
use App\Models\Station;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class StationController extends Controller
{
    public function index(): Response
    {
        // TODO: searched content name logic can be removed when it's handled in the front end instead.
//        $stations = Station::query();
//
//        // If a specific Content is requested, filter for stations that have the content.
//        $searchedContentName = request()->input('searched_content_name');
//        if (null !== $searchedContentName)
//        {
//            $contentsFound = Content::query()
//                ->whereLike('name', $searchedContentName)
//                ->pluck('id')
//                ->toArray();
//
//            $stationsWithSearchedContents = Locker::query()
//                ->whereIn('content_id', $contentsFound)
//                ->pluck('station_id')
//                ->toArray();
//
//            $stations->whereIn('id', $stationsWithSearchedContents);
//        }

        return Inertia::render('Stations/Index', [
//            'stations' => $stations->get()->load('lockers'),
            'stations' => Station::all()->load('lockers', 'lockers.content'),
//            'contentNames' => Content::all()->pluck('name')->toArray(),
//            'searchedContentName' => $searchedContentName,
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
        if (true === request()->filled('image')) {
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
}
