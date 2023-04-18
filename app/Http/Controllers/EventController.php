<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(20);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            return view('groups.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date'=>'required|string|max:255',
            'end_date'=>'required|string|max:255',
        ]);
        $event=new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();
        return redirect()->route('events.index')->with('success', __('messages.event_successfully_updated'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event=Event::findOrFail($id);
        return view('groups.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event=Event::findOrFail($id);
        return view('groups.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date'=>'required|string|max:255',
            'end_date'=>'required|string|max:255',
        ]);
        $event=Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();
        return redirect()->route('events.index')->with('success', __('messages.event_successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return redirect()->route('events.index')->with('success', __('messages.event_successfully_deleted'));
        }
    }
}
