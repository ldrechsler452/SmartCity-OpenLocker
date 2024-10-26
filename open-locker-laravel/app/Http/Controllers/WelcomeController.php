<?php
// app/Http/Controllers/WelcomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}