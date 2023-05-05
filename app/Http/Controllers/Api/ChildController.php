<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentId = 4;
        $children = Child::where('user_id', $parentId)->cursorPaginate(10);
        return response()->json($children);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'parent' => 'required|string|exists:users,id',
            'age' => 'required|string|max:255',
        ]);

        $child = new Child([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'user_id' => $request->get('parent'),
            'age' => $request->get('age'),
        ]);

        $child->save();
        return response()->json($child);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Child::findOrFail($id);
        return response()->json($child);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'firstname' => 'string|max:255',
        'lastname' => 'string|max:255',
        'age' => 'string|max:255',
    ]);

    $child = Child::findOrFail($id);
    $child->firstname = $request->get('firstname', $child->firstname);
    $child->lastname = $request->get('lastname', $child->lastname);
    $child->age = $request->get('age', $child->age);
    $child->save();

    return response()->json($child);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return ["Child"=>"Child has been deleted"];
    }
}
