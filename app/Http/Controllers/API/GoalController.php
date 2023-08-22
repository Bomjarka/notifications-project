<?php

namespace App\Http\Controllers\API;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoalController extends BaseControllers
{
    public function index(User $user)
    {
        return $this->sendSuccess($user->goals, 'All user goals');
    }

    public function show(Goal $goal)
    {
        return $this->sendSuccess($goal, 'Loan - ' . $goal->id);
    }

    public function delete(Goal $goal)
    {
        $goal->delete();

        return $this->sendSuccess($goal, 'Goal - ' . $goal->id . ' deleted');
    }

    public function update(Goal $goal, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'notify_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->messages()->all());
        }

        $updatedData = $validator->getData();
        $updatedData['updateNotificationDate'] = $updatedData['updateNotificationDate'] === 'true';

        $goal->name = $updatedData['name'];
        $goal->message = $updatedData['message'];
        if ($updatedData['updateNotificationDate'] === true) {
            $goal->notify_at = $updatedData['notify_at'];
        }
        $goal->save();

        return $this->sendSuccess($goal, 'Goal - ' . $goal->id . ' updated');
    }

    public function store(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'notify_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->messages()->all());
        }

        $goalData = array_merge($validator->getData(), ['user_id' => $user->id]);
        $goal = new Goal();
        $goal->name = $goalData['name'];
        $goal->message = $goalData['message'];
        $goal->notify_at = $goalData['notify_at'];
        $goal->user_id = $goalData['user_id'];
        $goal->save();

        return $this->sendSuccess($goal, 'Goal - ' . $goal->id . ' created');
    }
}
