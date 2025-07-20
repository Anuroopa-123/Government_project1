<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $timeline = Timeline::all();

        return view('dashboard', compact('users', 'timeline'));
    }
}
