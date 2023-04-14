<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups= Group::paginate(10);
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $children = Child::all();
        return view('groups.create', compact('children'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_players' => 'required|string|max:255',
            'children' => 'required|string|max:255|exists:children,id',

        ]);

        $group = new Group([
            'name' => $request->get('name'),
            'number_of_players' => $request->get('number_of_players'),
            'child_id' => $request->get('children'),
        ]);

        $group->save();

        return redirect()->route('groups.index')->with('success', 'Group has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $group = Group::with('children')->find($id);
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     */
    public function edit(string $id)

    {
        $group = Group::find($id);
        $children = Child::all();
        return view('groups.edit', compact('group', 'children'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_players' => 'required|string|max:255',
            'children' => 'required|string|max:255|exists:children,id',
        ]);
        $group = Group::find($id);
        $group->name = $request->get('name');
        $group->number_of_players = $request->get('number_of_players');
        $group->child_id = $request->get('children');
        $group->save();
        return redirect()->route('groups.index')->with('success', 'Group has been updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::find($id);
        if ($group) {
            $group->delete();
            return redirect()->route('groups.index')->with('success', 'Group has been deleted successfully.');
        }
    }
}
