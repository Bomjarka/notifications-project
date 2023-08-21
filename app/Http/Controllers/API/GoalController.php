<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class GoalController extends BaseControllers
{
    public function index(User $user)
    {
        return $this->sendSuccess($user->goals, 'All user goals');
    }
}
