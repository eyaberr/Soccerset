<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSubscription;
use Illuminate\Http\Request;

class UpdateAttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $child_id = $request->input('child_id');

        $subscription = EventSubscription::where('event_id', $event->id)
            ->where('child_id', $child_id)
            ->firstOrFail();

        $subscription->presence = $request->input('attendance');
        $subscription->save();

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }
}
