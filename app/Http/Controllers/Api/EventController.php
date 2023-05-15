<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $events = [];
            if ($user->role_id === User::ROLES['parent']) {
                $eventIds = $user->children->pluck('id')->toArray();
                $events = Event::whereHas('subscriptions', function (Builder $query) use ($eventIds) {
                    $query->whereIn('child_id', $eventIds);
                })->simplePaginate(10);
            } else if ($user->role_id === User::ROLES['trainer']) {
                $events = $user->events()->simplePaginate(10);
            }
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->role_id === User::ROLES['trainer']) {
            $event = Event::with('subscriptions')->where('user_id', $user->id)->find($id);

            if (!$event){
                return response()->json([
                   'error'=> 'Event Not Found',
                ], 404);
            }
        } else {
            $event = $user->event;
        }
        return response()->json([
            'event' => $event,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'attendance' => 'required|boolean',
            'stats' => 'required|json'
        ]);
        if ($user->role_id !== User::ROLES['trainer']) {
            throw new \Exception('this user is not a trainer', 422);
        }

            foreach ($user->event->subscriptions as $subscription) {

            }
        return response()->json([
            'event' => $user->event
        ]);
    }

}
