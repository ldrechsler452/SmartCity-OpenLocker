<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function show(): Response
    {
        $content = Content::query();

        /** @var User $currentUser */
        $currentUser = auth()->user();
        if (false === $currentUser->isAdmin())
        {
            $content->where('user_id', $currentUser->getId());
        }

        return Inertia::render('Dashboard', [
            'content' => $content->get(),
        ]);
    }
}
