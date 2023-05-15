<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;


class UpdateAttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role_id === User::ROLES['trainer']) {

            $request->validate([
                'attendance' => 'required|' . Rule::in(EventSubscription::STATUS)
            ]);
            $eventSubscription = EventSubscription::whereHas('event', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($id);
            $attendance = $request->input('attendance');
            $eventSubscription->attendance = $attendance == EventSubscription::STATUS['not_defined'] ? null : $attendance;
            $eventSubscription->save();
            return response()->json($eventSubscription);
        }
        return response()->json(['status' => 'error', 'message' => 'only trainers can perform this action'], 401);
    }
}
