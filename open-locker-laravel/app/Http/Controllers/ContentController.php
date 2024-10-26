<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContentController extends Controller
{
    public function index(): Response
    {
        $content = Content::query();

        /** @var User $currentUser */
        $currentUser = auth()->user();
        if (false === $currentUser->isAdmin())
        {
            $content->where('user_id', $currentUser->getId());
        }

        return Inertia::render('Content/Index', [
            'content' => $content->get(),
        ]);
    }
}
