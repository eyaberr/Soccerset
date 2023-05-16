<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateStatsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $user = Auth::user();
        $rules = ['stats' => 'required|array'];
        if ($user->role_id === User::ROLES['trainer']) {
            $eventSubscription = EventSubscription::whereHas('event', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('event')->findOrFail($id);

            switch ($eventSubscription->event->type) {
                case Event::TYPES['training']:
                    $rules['stats.goals'] = 'required|integer';
                    $rules['stats.touches'] = 'required|integer';
                case Event::TYPES['friendly_game']:
                    $rules['stats.attack'] = 'required|integer';
                    $rules['stats.defence'] = 'required|integer';
                    $rules['stats.dribble'] = 'required|integer';
                    break;
                case Event::TYPES['medical_checkup']:
                    $rules['stats.heart_rate'] = 'required|integer';
                    $rules['stats.blood_pressure'] = 'required|integer';
                    $rules['stats.height'] = 'required|integer';
                    $rules['stats.weight'] = 'required|integer';
                    break;
            }

            $request->validate($rules);
            $eventSubscription->stats = $request->input('stats');
            $eventSubscription->save();
            return response()->json($eventSubscription);
        }
        return response()->json(['status' => 'error', 'message' => 'only trainers can perform this action'], 401);
    }
}
