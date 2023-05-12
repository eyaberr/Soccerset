<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
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
        $event = Event::with('subscriptions')->findOrFail($id);
        return response()->json([
            'event' => $event,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $request->validate([
            'attendance' => 'required|boolean',
            'stats' => 'required|json'
        ]);
        $updatedEvents = collect();
        if ($user->role_id !== User::ROLES['trainer']) {
            throw new \Exception('this user is not a trainer', 422);
        }
        foreach ($user->events as $event) {
            foreach ($event->subscriptions as $subscription) {
                $subscription->attendance = $request->input('attendance', $subscription->attendance);
                $subscription->stats = $request->input('stats', $subscription->stats);
                $subscription->save();
            }
            $updatedEvents->push($event->refresh());
        }
        return response()->json([
            'events' => $updatedEvents,
        ]);
    }

}
