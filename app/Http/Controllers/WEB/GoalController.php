<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\User;

class GoalController extends Controller
{
    public function index(User $user)
    {
        return view('user.goals');
    }

    public function show(User $user, Goal $goal)
    {
        return view('user.goal', ['goal' => $goal]);
    }
}
