<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Event;
use App\Models\EventSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::withCount('subscriptions')->paginate(20);
        $types = array_flip(Event::TYPES);
        return view('events.index', compact('events', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::ofRole(User::ROLES['trainer'])->get();
        $types = Event::TYPES;
        $children = Child::all();
        return view('events.create', compact('users', 'types', 'children'));
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

        $children = $request->input('children');

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->user_id = $request->input('trainer');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();

        if ($children) {
            $dataToInsert = [];
            foreach ($children as $childrenId) {
                //$eventSubscription = new EventSubscription();
                //$eventSubscription->child_id = $childrenId;
                //$eventSubscription->event_id = $event->id;
                //$eventSubscription->save();
                //optimisation
                $dataToInsert[] = ['child_id' => $childrenId, 'event_id' => $event->id];
            }

            if (count($dataToInsert) > 0) {
                EventSubscription::insert($dataToInsert);
            }
        }


        return redirect()->route('events.index')->with('success', __('messages.event_successfully_updated'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $types = array_flip(Event::TYPES);
        return view('events.show', compact('event', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $selectedChildrenIds = $event->subscriptions->pluck('child_id')->toArray();
        $users = User::ofRole(User::ROLES['trainer'])->get();
        $types = Event::TYPES;
        $children = Child::all();
        return view('events.edit', compact('event', 'users', 'types', 'children', 'selectedChildrenIds'));
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
            'start_date' => 'required|before:end_date|date',
            'end_date' => 'required|date',
            'children' => 'array|exists:children,id'
        ]);
        $children = $request->input('children', []);

        $event = Event::with('subscriptions')->findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->user_id = $request->input('trainer');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();

        $childrenIdsSubscribedToEvents = $event->subscriptions->pluck('child_id')->toArray();

        $newSubscribedChildrenIds = array_diff($children, $childrenIdsSubscribedToEvents);
        $removedSubscribedChildrenIds = array_diff($childrenIdsSubscribedToEvents, $children);

        $dataToInsert = [];
        foreach ($newSubscribedChildrenIds as $childrenId) {
            //$eventSubscription = new EventSubscription();
            //$eventSubscription->child_id = $childrenId;
            //$eventSubscription->event_id = $event->id;
            //$eventSubscription->save();
            //optimisation
            $dataToInsert[] = ['child_id' => $childrenId, 'event_id' => $event->id];
        }

        if (count($dataToInsert) > 0) {
            EventSubscription::insert($dataToInsert);
        }

        if (count($removedSubscribedChildrenIds) > 0) {
            EventSubscription::where('event_id', $event->id)
                ->whereIn('child_id', $removedSubscribedChildrenIds)
                ->delete();
        }

        return redirect()->route('events.index')->with('success', __('messages.event_successfully_updated'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        if ($event) {
            $event->delete();
            return redirect()->route('events.index')->with('success', __('messages.event_successfully_deleted'));
        }
    }
}
