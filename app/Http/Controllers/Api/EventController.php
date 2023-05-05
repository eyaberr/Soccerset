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
        $events = Event::cursorPaginate(10);
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
            'type' => 'required|integer|' . Rule::in(Event::TYPES),
            'trainer' => 'required|string|max:255|exists:users,id',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'children' => 'array|exists:children,id'
        ]);


        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->user_id = $request->input('trainer');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();
        return response()->json($event);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('subscriptions.child')->findOrFail($id);
        return response()->json([
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|integer|' . Rule::in(Event::TYPES),
            'trainer' => 'required|string|max:255|exists:users,id',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'children' => 'array|exists:children,id'
        ]);
        $event = Event::with('subscriptions')->findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->user_id = $request->input('trainer');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();

        return ["Event"=>"Event has been updated"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return ["Event"=>"Event has been deleted"];
    }
}
