<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::cursorPaginate(10);
        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_players' => 'required|integer',
            'children' => 'required|array|exists:children,id',
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->number_of_players = $request->input('number_of_players');
        $group->save();
        $group->children()->sync($request->input('children'));
        return ["GROUP"=>"Group has been saved"];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $group = Group::with('children')->findOrFail($id);
        $childCount = $group->children()->count();
        return response()->json([
            'group' => $group,
            'childCount' => $childCount,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_players' => 'required|integer',
            'children' => 'required|array|exists:children,id',
        ]);
        $group = Group::findOrFail($id);
        $group->name = $request->input('name');
        $group->number_of_players = $request->input('number_of_players');
        $group->save();

        $group->children()->sync($request->input('children'));
        return ["GROUP"=>"Group has been updated"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return ["Group"=>"Group has been deleted"];
    }
}
