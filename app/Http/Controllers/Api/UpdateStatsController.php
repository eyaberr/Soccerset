<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        if ($user->role_id === User::ROLES['trainer']) {
            $request->validate([
                'stats' => 'required|array'
            ]);
            $stats = $request->input('stats');

            $eventSubscription = EventSubscription::whereHas('event', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($id);

            $eventSubscription->stats = $stats;
            $eventSubscription->save();
            return response()->json($eventSubscription);
        }
        return response()->json(['status' => 'error', 'message' => 'only trainers can perform this action'], 401);
    }
}
