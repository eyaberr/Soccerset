<?php

namespace App\Http\Controllers;

use App\Models\EventSubscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateAttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'attendance' => 'required|integer|' . Rule::in(EventSubscription::STATUS)
        ]);
        $eventSubscription = EventSubscription::findOrFail($id);
        $eventSubscription->attendance = $request->input('attendance') == EventSubscription::STATUS['not_defined'] ? null : $request->input('attendance');
        $eventSubscription->save();

        return redirect()->back()
            ->with('success', __('messages.attendance_successfully_updated'));
    }
}
