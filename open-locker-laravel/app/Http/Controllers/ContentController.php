<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use App\Services\ScriptService;

class ContentController extends Controller
{
    public function take(Content $content): void
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $content
            ->setUser($currentUser)
            ->setTakenAt(now())
            ->save();

        ScriptService::openLocker($content->getLocker());
    }

    public function return(Content $content): void
    {
        $content
            ->setUser(null)
            ->setTakenAt(null)
            ->save();

        ScriptService::openLocker($content->getLocker());
    }
}
