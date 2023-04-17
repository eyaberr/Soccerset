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
        $groups = Group::with('children')->paginate(20);
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
            'number_of_players' => 'required|integer',
            'children' => 'required|array|exists:children,id',
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->number_of_players = $request->input('number_of_players');
        $group->children=$request->input('children');
        $group->save();

        $group->children()->sync($request->input('children'));

        return redirect()->route('groups.index')->with('success', __('messages.group_successfully_updated'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $group = Group::with('children')->findOrFail($id);
        $childCount = $group->children()->count();
        return view('groups.show', compact('group', 'childCount'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     */
    public function edit(string $id)
    {
        $group = Group::with('children')->findOrFail($id);
        $children=Child::all();
        return view('groups.edit', compact('group','children'));
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
        $group = Group::find($id);
        $group->name = $request->input('name');
        $group->number_of_players = $request->input('number_of_players');
        $group->children = $request->get('children');
        $group->save();
        return redirect()->route('groups.index')->with('success', __('messages.group_successfully_updated'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::find($id);
        if ($group) {
            $group->delete();
            return redirect()->route('groups.index')->with('success', __('messages.group_successfully_deleted'));
        }
    }
}
