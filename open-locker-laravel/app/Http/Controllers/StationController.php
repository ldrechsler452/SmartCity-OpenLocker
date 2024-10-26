<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Locker;
use App\Models\Station;
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
}
