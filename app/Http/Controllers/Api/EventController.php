<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainerId = 2;
        $events = Event::where('user_id', $trainerId)->cursorPaginate(10);
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|integer|in:' . Rule::in(Event::TYPES),
            'trainer' => 'required|string|max:255|exists:users,id',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'children' => 'array|exists:children,id'
        ]);
        $event = new Event();
        $event->fill($request->all());
        $event->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('subscriptions.child')->findOrFail($id);
        $types = array_flip(Event::TYPES);
        $statutes = EventSubscription::STATUS;
        return response()->json([$event,$types,$statutes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
