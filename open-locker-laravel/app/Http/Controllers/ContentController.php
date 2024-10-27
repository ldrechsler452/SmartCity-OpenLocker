<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Locker;
use App\Models\Station;
use App\Models\User;
use App\Services\ImageService;
use App\Services\ScriptService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContentController extends Controller
{
    public function create(): Response
    {
        $forStationId = request()->input('station_id');
        if (null !== $forStationId) {
            /** @var Station $station */
            $station = Station::find($forStationId);
            $lockers = $station->getLockers();
        } else {
            $lockers = Locker::all();
        }

        return Inertia::render('Content/Create', [
            'lockers' => $lockers,
        ]);
    }

    public function store()
    {
        $image = null;
        $imageFile = null;
        if (null !== request()->file('image')) {
            $imageFile = request()->file('image');
            $image = ImageService::store($imageFile);
        }

        $content = (new Content())
            ->setName(request()->input('name'));

        if (null !== $imageFile)
        {
            $content->setImage($image);
        }

        return Inertia::render('Content/Store');
    }

    public function delete(Content $content): RedirectResponse
    {
        ImageService::delete($content->getImage());
        $content->delete();

        return redirect()->route('contents.index');
    }

    public function take(Content $content): Response
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $content
            ->setUser($currentUser)
            ->setTakenAt(now())
            ->save();

        ScriptService::openLocker($content->getLocker());

        return Inertia::render('Contents/Taken', [
            'content' => $content,
        ]);
    }

    public function return(Content $content): Response
    {
        $content
            ->setUser(null)
            ->setTakenAt(null)
            ->save();

        ScriptService::openLocker($content->getLocker());

        return Inertia::render('Contents/Returned', [
            'content' => $content,
        ]);
    }

    public function image(Content $content): StreamedResponse
    {
        return Storage::download($content->getImage()?->getFilePath());
    }
}
