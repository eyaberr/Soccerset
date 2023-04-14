<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Child::with('user')->paginate(20);
        return view('children.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::ofRole(User::ROLES['parent'])->get();
        return view('children.create', compact('users'));
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

        $child->save();

        return redirect()->route('children.index')->with('success', __('messages.child_successfully_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Child::find($id);
        return view('children.show', compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {
        $child = Child::find($id);
        $users = User::ofRole(User::ROLES['parent'])->get();
        return view('children.edit', compact('child', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'parent' => 'required|string|max:255|exists:users,id',
            'age' => 'required|string|max:255',
        ]);

        $child = Child::find($id);
        $child->firstname = $request->get('firstname');
        $child->lastname = $request->get('lastname');
        $child->user_id = $request->get('parent');
        $child->age = $request->get('age');
        $child->save();

        return redirect()->route('children.index')->with('success', __('messages.child_successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child = Child::find($id);
        if ($child) {
            $child->delete();
            return redirect()->route('children.index')->with('success', __('messages.child_successfully_deleted'));
        }
    }
}
