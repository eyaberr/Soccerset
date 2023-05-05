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
        $parentId=4;
        $children = Child::where('user_id',$parentId)->cursorPaginate(10);
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
            'parent' => 'required|string|max:255|exists:users,id',
            'age' => 'required|string|max:255',
        ]);

        $child = new Child([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'user_id' => $request->get('parent'),
            'age' => $request->get('age'),
        ]);

        $child->save();    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
