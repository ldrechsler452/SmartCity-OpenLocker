<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => User::all(),
        ]);
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }
}
