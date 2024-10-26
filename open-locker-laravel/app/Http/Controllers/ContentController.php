<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use App\Services\ScriptService;
use Inertia\Inertia;
use Inertia\Response;

class ContentController extends Controller
{
    public function take(Content $content): Response
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $content
            ->setUser($currentUser)
            ->setTakenAt(now())
            ->save();

        ScriptService::openLocker($content->getLocker());

        return Inertia::render('Content/Taken', [
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

        return Inertia::render('Content/Returned', [
            'content' => $content,
        ]);
    }
}
